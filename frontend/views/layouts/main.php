<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\assets\FontAwesomeAsset;
use Yii;

AppAsset::register($this);
FontAwesomeAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

</head>
<body class="home page">

<?php $this->beginBody() ?>

<div class="wrapper">
    <header>
        <div class="header-top">
            <div class="container">
                <div class="col-md-4 col-sm-4 col-md-offset-4 col-sm-offset-4 brand-logo">
                    <h1>
                        <a href="#">
                            <img src="/img/logo.png" alt="">
                        </a>
                    </h1>
                </div>
                <div class="col-md-4 col-sm-4 navicons-topbar">
                    <ul>
                        <li class="blog-search">
                            <?=Html::beginForm(['/site/language'])?>
                            <?=Html::dropDownList('language',Yii::$app->language ,[
                                'en-US' => 'English',
                                'ru-RU' => 'Russian',
                            ])?>
                            <?=Html::submitButton('Change',['class' => 'btn-link'])?>
                            <?=Html::endForm()?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="header-main-nav">
            <div class="container">
                <div class="main-nav-wrapper">
                    <nav class="main-menu">

                        <?php

                        $menuItems = [
                            ['label' => Yii::t('menu','Newsfeed'), 'url' => ['/site/index']],
                        ];
                        if (Yii::$app->user->isGuest) {
                            $menuItems[] = ['label' => Yii::t('menu','Signup'), 'url' => ['/user/default/signup']];
                            $menuItems[] = ['label' => Yii::t('menu','Login'), 'url' => ['/user/default/login']];
                        } else {
                            $menuItems[] = ['label' => Yii::t('menu','My page'),
                                'url' => ['/user/profile/view','nickname' => Yii::$app->user->identity->getNickname()]];
                            $menuItems[] = ['label' => Yii::t('menu','Create Post'), 'url' => ['/post/default/create']];
                            $menuItems[] = '<li>'
                                . Html::beginForm(['/user/default/logout'], 'post')
                                . Html::submitButton(
                                    Yii::t('menu', 'Logout ({username})',[
                                        'username' => Yii::$app->user->identity->username
                                    ]),['class' => 'btn btn-link logout'])
                                . Html::endForm()
                                . '</li>';

                        }
                        echo Nav::widget([
                            'options' => ['class' => 'menu navbar-nav navbar-right'],
                            'items' => $menuItems,
                        ]);

                        ?>

                    </nav>
                </div>
            </div>
        </div>

    </header>

    <div class="container full">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>

    <div class="push">
    </div>


    <footer>
        <div class="footer">
            <div class="back-to-top-page">
                <a class="back-to-top"><i class="fa fa-angle-double-up"></i></a>
            </div>
            <p class="text">Social | 2018</p>
        </div>
    </footer>

    </div>

<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>