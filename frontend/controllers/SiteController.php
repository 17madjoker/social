<?php
namespace frontend\controllers;

use frontend\models\User;
use Yii;
use yii\web\Controller;
use frontend\models\ContactForm;


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

}
