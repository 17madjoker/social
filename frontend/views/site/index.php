<?php

/**
 * @var $this yii\web\View
 * @var $users [] frontend\models\User
 */

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\JqueryAsset;

$this->title = 'Vikings';
?>

<div class="page-posts no-padding">
    <div class="row">
        <div class="page page-post col-sm-12 col-xs-12">
            <div class="blog-posts blog-posts-large">

                <div class="row">

                    <?php if ($feeds): ?>
                        <?php foreach ($feeds as $feed): ?>

                            <article class="post col-sm-12 col-xs-12">
                                <div class="post-meta">
                                    <div class="post-title">
                                        <img src="<?= $feed->author_picture ?>" alt="" width="100" height="100"
                                             class="img-thumbnail">

                                        <div class="author-name"><p><a
                                                    href="<?= Url::to(['/user/profile/view', 'nickname' => $feed->author_id]) ?>">
                                                    <?= Html::encode($feed->author_name) ?></a></p></div>
                                    </div>
                                </div>
                                <div class="post-type-image">
                                    <a href="<?=Url::to(['/post/default/view','id' => $feed->post_id])?>">
                                    <img src="/uploads/<?= $feed->post_filename ?>" alt="" class="img-thumbnail">
                                    </a>
                                </div>
                                <div class="post-description">
                                    <p>Description: </b><?= Html::encode($feed->post_description) ?></p>
                                </div>
                                <div class="post-bottom">
                                    <div class="post-likes">
                                        <a href="" class="btn btn-default button-like" data-id="<?= $feed->post_id ?>"
                                           style="<?php echo ($currentUser->likesPost($feed->post_id)) ? 'display:none' : '' ?>">
                                            Like <span class="glyphicon glyphicon-thumbs-up"></span>
                                        </a>
                                        <a href="" class="btn btn-default button-dislike"
                                           data-id="<?= $feed->post_id ?>"
                                           style="<?php echo ($currentUser->likesPost($feed->post_id)) ? '' : 'display:none' ?>">
                                            Dislike <span class="glyphicon glyphicon-thumbs-down"></span>
                                        </a>
                                        <span id="totallikes">Total likes: <span
                                                class="glyphicon glyphicon-thumbs-up"></span>:</b> <?= $feed->countLikes() ?></span>
                                    </div>
                                    <div class="post-comments">
                                        <a href="#">6 Comments</a>

                                    </div>
                                    <div class="post-date">
                                        <span><?= Yii::$app->formatter->asDatetime(Html::encode($feed->post_created_at)) ?></span>
                                    </div>
                                    <div class="post-report">
                                        <a href="#">Report post</a>
                                    </div>
                                </div>
                            </article>

                        <?php endforeach ?>
                    <?php endif ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php

$this->registerJsFile('@web/js/like.js', [
    'depends' => JqueryAsset::className()
]);

?>










