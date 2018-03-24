<?php
namespace frontend\controllers;

use frontend\models\User;
use Yii;
use yii\web\Controller;
use frontend\models\ContactForm;
use yii\web\Cookie;


/**
 * Site controller
 */
class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect('/user/default/login');
        }

        $currentUser = Yii::$app->user->identity;
        $limit = Yii::$app->params['feedPostLimit'];
        $feeds = $currentUser->getFeed($limit);

        return $this->render('index',[
            'feeds' => $feeds,
            'currentUser' => $currentUser
        ]);
    }

    public function actionLanguage()
    {
        $language = Yii::$app->request->post('language');
        Yii::$app->language = $language;

        $languageCookie = new Cookie([
            'name' => 'language',
            'value' => $language,
            'expire' => time() + 60*60*24*30,
        ]);
        Yii::$app->response->cookies->add($languageCookie);
        return $this->redirect(Yii::$app->request->referrer);
    }

}
