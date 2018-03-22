<?php

use yii\helpers\Html;

?>

<div class="row">

    <div class="col-md-6">
        <p><img src="<?=$post->getImage()?>" alt="" class="img-responsive img-thumbnail" width="200" height="200"></p>
        <?php if ($post->user):?>
            <p>Post was created by : <i><?=$post->user->username?></i></p>
        <?php endif ?>
        <p>
            <a href="" class="btn btn-primary button-like" data-id="<?=$post->id?>"
                style="<?php echo ($currentUser and $post->isLikedBy($currentUser)) ? 'display:none' : ''; ?>">
                Like <span class="glyphicon glyphicon-thumbs-up"></span>
            </a>
            <a href="" class="btn btn-default button-dislike" data-id="<?=$post->id?>"
                style="<?php echo ($currentUser and $post->isLikedBy($currentUser)) ? '' : 'display:none'; ?>">
                Dislike <span class="glyphicon glyphicon-thumbs-down"></span>
            </a>
        </p>
        <div class="likes-count" id="test">Total count <span class="glyphicon glyphicon-thumbs-up"></span>
            : <?=$post->countLikes()?></div>
    </div>

    <div class="col-md-6">
        <h3 class="text-center"><?=$post->description?></h3>
    </div>

</div>

<?php

$this->registerJsFile('@web/js/like.js',[
    'depends' => \yii\web\JqueryAsset::className(),
]);

?>
