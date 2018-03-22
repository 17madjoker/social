<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<h3>Create post</h3>

<?php $form = ActiveForm::begin([
    'options' => ['class' => 'form-horizontal'],
]) ?>

    <?=$form->field($model,'picture')->fileInput()?>

    <?=$form->field($model,'description')->textarea()?>

    <?=Html::submitButton('Create',['class' => 'btn btn-default'])?>

<?php $form = ActiveForm::end() ?>
