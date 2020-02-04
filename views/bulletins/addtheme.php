<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
?>
<div class="panel panel-primary">
    <div class="panel panel-heading">
        <?= $currBulletin->id ?> <?= $currBulletin->title ?>
    </div>
    <div class="panel-body">
        <?= $currBulletin->info ?>
        <hr>
        <?php
        $newTheme = $model->getListThemes($currBulletin->id);
        //app\models\ThemesRecord::find()->all();
        $items = ArrayHelper::map($newTheme, 'id', 'title');
        ?>
        <?php $form = ActiveForm::begin() ?>
        <?= $form->field($model, 'themes_id')->dropDownList($items); ?>
        <button type="submit" class="btn btn-success" >
            Сохранить
        </button>
        <?php ActiveForm::end() ?>
        <hr>
        <?php
        foreach ($currBulletin->themesbulletins as $tb) {
            ?>
        <a class="btn btn-default" title="Удалить тему" href="/bulletins/deletetheme?id=<?=$tb->id ?>">
                <?= $tb->themes->title ?>
            <i class="glyphicon glyphicon-remove"></i>
        </a>

        <?
        }?>
    </div>
</div>