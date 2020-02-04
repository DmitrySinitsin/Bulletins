<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Добавление фото';
$this->params ['breadcrumbs'][]=$this->title;
?>

<?php $form=ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

<?= $form->field($photo, 'file')->fileInput() ?>

<?= Html::submitButton('Сохранить',['class'=>'btn btn-primary','name'=>'addphoto-button']); ?>

<?php ActiveForm::end() ?>