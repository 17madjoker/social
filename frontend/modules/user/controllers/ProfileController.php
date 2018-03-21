<?php

namespace frontend\modules\user\controllers;
use yii\web\Controller;
use frontend\models\User;
use Faker\Factory;
use Yii;
use yii\web\NotFoundHttpException;

class ProfileController extends Controller
{
    public function actionView($nickname)
    {
        $currentUser = Yii::$app->user->identity;
        $user = self::findUser($nickname);

        return $this->render('view',[
            'user' => $user,
            'currentUser' => $currentUser
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