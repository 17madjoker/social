<?php

namespace frontend\modules\user\controllers;
use yii\web\Controller;
use frontend\models\User;
use Faker\Factory;
use Yii;
use yii\web\NotFoundHttpException;
use frontend\modules\user\models\forms\PictureForm;
use yii\web\Response;
use yii\web\UploadedFile;

class ProfileController extends Controller
{
    public function actionView($nickname)
    {
        $modelPicture = new PictureForm();
        $currentUser = Yii::$app->user->identity;
        $user = self::findUser($nickname);

        return $this->render('view',[
            'user' => $user,
            'currentUser' => $currentUser,
            'modelPicture' => $modelPicture
        ]);
    }

    public function findUser($nickname)
    {
        if($user = User::find()->where(['nickname' => $nickname])
            ->orWhere(['id' => $nickname])
            ->one())
        {
            return $user;
        }
    }

    public function actionUnsubscribe($id)
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['/user/default/login']);
        }

        /** @var $currentUser User */
        $currentUser = Yii::$app->user->identity;

        $user = $this->getUserById($id);

        $currentUser->unfollowUser($user);

        return $this->redirect(['/user/profile/view','nickname' => $user->getNickname()]);
    }

    public function actionSubscribe($id)
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['/user/default/login']);
        }

        /** @var $currentUser User */
        $currentUser = Yii::$app->user->identity;

        $user = $this->getUserById($id);

        $currentUser->followUser($user);

        return $this->redirect(['/user/profile/view','nickname' => $user->getNickname()]);
    }

    /**
     * @param $id
     * @return null|static
     * @throws NotFoundHttpException
     */
    public function getUserById($id)
    {
        if ($user = User::findOne($id))
        {
            return $user;
        }
        throw new NotFoundHttpException;
    }

    public function actionUploadPicture()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = new PictureForm();
        $model->picture = UploadedFile::getInstance($model, 'picture');

        if ($model->validate())
        {
            $user = Yii::$app->user->identity;
            $user->picture = Yii::$app->storage->saveUploadFile($model->picture);

            if ($user->save(false, ['picture']))
            {
                return [
                    'success' => true,
                    'pictureUri' => Yii::$app->storage->getFile($user->picture),
                ];
            }
            return ['success' => false, 'errors' => $model->getErrors()];
        }
    }

    public function actionDeletePicture()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['/user/default/login']);
        }

        $currentUser = Yii::$app->user->identity;

        if ($currentUser->deletePicture())
        {
            Yii::$app->session->setFlash('success','Picture was deleted');
        } else{
            Yii::$app->session->setFlash('danger','Error');
        }
        return $this->redirect(['/user/profile/view','nickname' => $currentUser->getNickname()]);
    }

//    public function actionGenerate()
//    {
//        $faker = Factory::create();
//
//        for ($i = 0; $i < 10; $i++)
//        {
//            $user = new User([
//                'username' => $faker->name,
//                'email' => $faker->email,
//                'about' => $faker->text(rand(100,250)),
//                'nickname' => $faker->regexify('[A-Za-z0-9_]{4,12}'),
//                'auth_key' => Yii::$app->security->generateRandomString(),
//                'password_hash' => Yii::$app->security->generateRandomString(),
//                'created_at' => $time = time(),
//                'updated_at' => $time,
//            ]);
//            $user->save(false);
//        }
//    }
}