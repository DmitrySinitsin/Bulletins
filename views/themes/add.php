<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \yii\helpers\ArrayHelper;

$this->title = "Добавление / редактирование темы";
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin() ?>
<?php
    $parent_themes=$currTheme->parent_themes_find();
    $items=ArrayHelper::map($parent_themes,'id','title');
    $params=['prompt'=>'Корневая тема...'];
?>
<?= $form->field($currTheme, 'parental_id')->dropDownList($items, $params) ?>
<?= $form->field($currTheme, 'title')->textInput() ?>
<?= $form->field($currTheme, 'info')->textarea() ?>
<button type="submit" class="btn btn-success">
    Сохранить
</button>

<a class="btn btn-default" href="<?= $prev_url ?>">
    Отмена
</a>
<?php ActiveForm::end() ?>