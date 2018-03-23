<?php

/**
 * @var $modelPicture frontend\modules\user\models\forms\PictureForm
 */

use yii\helpers\Html;
use yii\helpers\Url;
use dosamigos\fileupload\FileUpload;

?>

<div class="container full">

    <div class="page-posts no-padding">
        <div class="row">
            <div class="page page-post col-sm-12 col-xs-12 post-82">


                <div class="blog-posts blog-posts-large">

                    <div class="row">

                        <!-- profile -->
                        <article class="profile col-sm-12 col-xs-12">
                            <div class="profile-title">
                                <img src="<?=$user->getPicture()?>" alt=""
                                     class="img-responsive img-thumbnail" width="200" height="200" id="profile-picture">
                                &nbsp;&nbsp;&nbsp;
                                <div class="author-name"><?= Html::encode($user->username) ?></div>

                                <?php if ($currentUser && $user->equals($currentUser)): ?>


                                    <div class="alert alert-success" style="display: none"
                                         id="profile-image-success">Profile image set</div>
                                    <div class="alert alert-danger" style="display: none"
                                         id="profile-image-fail"></div>

                                    <?= FileUpload::widget([
                                        'model' => $modelPicture,
                                        'attribute' => 'picture',
                                        'url' => ['/user/profile/upload-picture'], // your url, this is just for demo purposes,
                                        'options' => ['accept' => 'image/*'],
                                        'clientOptions' => [
                                            'maxFileSize' => 2000000
                                        ],
                                        // Also, you can specify jQuery-File-Upload events
                                        // see: https://github.com/blueimp/jQuery-File-Upload/wiki/Options#processing-callback-options
                                        'clientEvents' => [
                                            'fileuploaddone' => 'function(e, data) {
                            if (data.result.success){
                                $("#profile-image-fail").hide();
                                $("#profile-picture").attr("src",data.result.pictureUri);
                            } else{
                                $("#profile-image-fail").html(data.result.errors.picture).show();
                                $("#profile-image-success").hide();
                            }
                            }',
                                            'fileuploadfail' => 'function(e, data) {
                                console.log(e);
                                console.log(data);
                            }',
                                        ],
                                    ]); ?>
                                    <a href="<?=Url::to(['/user/profile/delete-picture'])?>" class="btn btn-default">Delete image</a>

                                <?php endif ?>

                            </div>

                            <div class="profile-description">
                                <p><?= Html::encode($user->about) ?></p>
                            </div>

                            <p>
                                <?php if ($currentUser && !$user->equals($currentUser)): ?>

                                <?php if (!$currentUser->isFollowing($user)): ?>
                                    <a href="<?= Url::to(['/user/profile/subscribe', 'id' => $user->getId()]) ?>" class="btn btn-success">Subscribe</a>
                                <?php else: ?>
                                    <a href="<?= Url::to(['/user/profile/unsubscribe', 'id' => $user->getId()]) ?>" class="btn btn-default">Unsubscribe</a>
                                <?php endif ?>

                            <p>Friends also subscribed on it
                                <?php foreach ($currentUser->getCommonSubscription($user) as $item): ?>
                            <p><a href="<?= Url::to(['/user/profile/view',
                                    'nickname' => ($item['nickname']) ? $item['nickname'] : $item['id']]) ?>"  class="text-info">
                                    <?= Html::encode($item['username']) ?>
                                </a></p>
                            <?php endforeach; ?>
                            <?php endif ?>
                            </p>
                            </p>
                            <hr>

                            <div class="profile-bottom">
                                <div class="profile-post-count">
                                    <span><?= $user->getPostCount() ?> posts</span>
                                </div>
                                <div class="profile-followers">
                                    <a href="#myModal1" class="btn btn-default" data-toggle="modal">
                                        Subscription <?= $user->countSubscriptions() ?></a>
                                </div>
                                <div class="profile-following">
                                    <a href="#myModal2" class="btn btn-default" data-toggle="modal">
                                        Followers <?= $user->countFollowers() ?></a>
                                </div>
                            </div>
                        </article>

                        <div class="col-sm-12 col-xs-12">

                            <div class="row profile-posts">
                                <?php foreach($user->getPosts() as $post):?>

                                <div class="col-md-4 profile-post">
                                    <a href="<?=Url::to(['/post/default/view', 'id' => $post->id])?>"><img src="<?=$post->getImage()?>" class="author-image" /></a>
                                    <h5><?=$post->description?></h5>
                                </div>

                                <?php endforeach ?>
                            </div>

                        </div>


                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- HTML-код модального окна -->
<div id="myModal1" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Заголовок модального окна -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Subscription</h4>
            </div>
            <!-- Основное содержимое модального окна -->
            <div class="modal-body">
                <?php foreach ($user->getSubscriptions() as $subscriber): ?>
                    <p><a href="<?= Url::to(['/user/profile/view',
                            'nickname' => ($subscriber['nickname']) ? $subscriber['nickname'] : $subscriber['id']
                        ]) ?>">
                            <?= Html::encode($subscriber['username']) ?>
                        </a></p>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<!-- HTML-код модального окна -->
<div id="myModal2" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Заголовок модального окна -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Subscription</h4>
            </div>
            <!-- Основное содержимое модального окна -->
            <div class="modal-body">
                <?php foreach ($user->getFollowers() as $follower): ?>
                    <p><a href="<?= Url::to(['/user/profile/view',
                            'nickname' => ($follower['nickname']) ? $follower['nickname'] : $follower['id']
                        ]) ?>">
                            <?= Html::encode($follower['username']) ?>
                        </a></p>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>