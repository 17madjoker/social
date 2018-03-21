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
        $users = User::find()->all();
        return $this->render('index',[
            'users' => $users
        ]);
    }

}
