<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="row">
    <h3>Hello, <?=Html::encode($user->username)?></h3>
    <p>
        <a href="<?=Url::to(['/user/profile/subscribe','id' => $user->getId()])?>" class="btn btn-success">Subscribe</a>
        <a href="<?=Url::to(['/user/profile/unsubscribe','id' => $user->getId()])?>" class="btn btn-default">Unsubscribe</a>
    </p>
    <p><?=Html::encode($user->about)?></p>
    <hr>
    <p><a href="#myModal1" class="btn btn-default" data-toggle="modal">
            Subscription <?=$user->countSubscriptions()?></a>
       <a href="#myModal2" class="btn btn-default" data-toggle="modal">
           Followers <?=$user->countFollowers()?></a>
    </p>
    <p>
        <?php foreach($currentUser->getCommonSubscription($user) as $item): ?>
        <p><a href="<?=Url::to(['/user/profile/view',
            'nickname' => ($item['nickname']) ? $item['nickname'] : $item['id']
        ])?>">
            <?=Html::encode($item['username'])?>
        </a></p>
    <?php endforeach; ?>
    </p>

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
                <?php foreach($user->getSubscriptions() as $subscriber): ?>
                    <p><a href="<?=Url::to(['/user/profile/view',
                            'nickname' => ($subscriber['nickname']) ? $subscriber['nickname'] : $subscriber['id']
                        ])?>">
                            <?=Html::encode($subscriber['username'])?>
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
                <?php foreach($user->getFollowers() as $follower): ?>
                    <p><a href="<?=Url::to(['/user/profile/view',
                            'nickname' => ($follower['nickname']) ? $follower['nickname'] : $follower['id']
                        ])?>">
                            <?=Html::encode($follower['username'])?>
                        </a></p>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>