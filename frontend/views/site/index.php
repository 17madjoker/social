<?php

/**
 * @var $this yii\web\View
 * @var $users[] frontend\models\User
 */

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\JqueryAsset;

$this->title = 'My Yii Application';
?>
<div class="site-index">

<?php if ($feeds): ?>

    <?php foreach($feeds as $feed): ?>

    <div class="row">

        <div class="col-md-4">
            <h3><a href="<?=Url::to(['/user/profile/view','nickname' => $feed->author_id])?>">
                    <?=Html::encode($feed->author_name)?></a></h3>
            <p><img src="<?= $feed->author_picture ?>" alt="" width="100" height="100" class="img-thumbnail"></p>
        </div>

        <div class="col-md-8">
            <p><img src="/uploads/<?= $feed->post_filename ?>" alt="" class="img-thumbnail"></p>
            <p><b>Description: </b><?=Html::encode($feed->post_description)?></p>
            <p><b>Likes <span class="glyphicon glyphicon-thumbs-up"></span>:</b> <?=$feed->countLikes()?></p>
            <p>
                <a href="" class="btn btn-primary button-like" data-id="<?=$feed->post_id?>"
                    style="<?php echo ($currentUser->likesPost($feed->post_id)) ? 'display:none' : ''?>">
                    Like <span class="glyphicon glyphicon-thumbs-up"></span>
                </a>
                <a href="" class="btn btn-default button-dislike" data-id="<?=$feed->post_id?>"
                   style="<?php echo ($currentUser->likesPost($feed->post_id)) ? '' : 'display:none'?>">
                    Dislike <span class="glyphicon glyphicon-thumbs-down"></span>
                </a>
            </p>
            <mark><?= Yii::$app->formatter->asDatetime(Html::encode($feed->post_created_at)) ?></mark>
        </div>

    </div>
    <hr>
    <?php endforeach ?>

<?php endif ?>

</div>

<?php

$this->registerJsFile('@web/js/like.js',[
    'depends' => JqueryAsset::className()
]);

?>
