<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title='Регистрация';
$this->params['breadcrumbs'][]=$this->title;
?>

<?php $form=ActiveForm::begin(['id'=>'adduser-form']);?>
<div class="row">
    <div class="col-lg-6 col-md-6">
        <?= $form->field($newUser, 'username')->textInput(['autofocus'=>'true']) ?>
        <?= $form->field($newUser, 'password')->passwordInput() ?>
        <?= $form->field($newUser, 'confirmPassword')->passwordInput() ?>
    </div>
    <div class="col-lg-6 col-md-6">
        <?= $form->field($newUser, 'surname')->textInput() ?>
        <?= $form->field($newUser, 'name')->textInput() ?>
        <?= $form->field($newUser, 'middlename')->textInput() ?>
        <button type="submit" class="btn btn-primary">
            Сохранить
        </button>
    </div>
</div>







<?php ActiveForm::end();?>