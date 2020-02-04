<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Добавить объявление';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin() ?>

<div class="col-lg-6 col-md-6">
    <div class="panel panel-success">
        <div class="panel-heading">
            Добавить объявление
        </div>
        <div class="panel-body">

            <?= $form->field($model, 'title')->textInput() ?>
            <?= $form->field($model, 'info')->textarea() ?>
            <?= $form->field($model, 'contacts')->textarea() ?>
        </div>
    </div>
</div>
<div class="col-lg-6 col-md-6">
    <div class="panel panel-success">
        <div class="panel-heading">
            Добавить атрибуты
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'city')->textInput() ?>
            <?= $form->field($model, 'price')->textInput() ?>
            <button type="submit" class="btn btn-primary">
                Сохранить
            </button>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
