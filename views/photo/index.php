<?php

use yii\helpers\Html;

$this->title = 'Фото';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
    <a class="btn btn-default" href="/photo/add?id=<?=$currBulletin->id?>">Добавить фото</a>
</div>
<div class="row">
    <?php foreach ($currBulletin->photo as $photo_) {
        ?>
    <div class="col-sm-6 col-md-4 col-lg-3">
        <a class="thumbnail">
            <img src="/<?=$photo_->link?>" alt="no_photo" >
            <p>
                <?=$photo_->info?>
            <div class="input-group info" style="display:none" data-id="<?=$photo_->id?>">
                <input type="text" data-id="<?=$photo_->id?>" class="form-control infofield">
                <span class="input-group-btn">
                    <button class="btn btn-success infosave" data-id="<?=$photo_->id?>">
                        <i class="glyphicon glyphicon-ok"></i>
                    </button>
                </span>
            </div>
                
            </p>
        </a>
        <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" >
                Управление <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="#" class="infobutton" data-id="<?=$photo_->id?>">Информация</a></li>
                <li><a href="#"class="avabutton" data-id="<?=$photo_->id?>" bull="<?=$currBulletin->id?>">Сделать главной</a></li>
                <li class="divider" role="separator"></li>
                <li><a href="#" class="deletebutton"data-id="<?=$photo_->id?>">Удалить фото</a></li>
            </ul>
        </div>
    </div>
    <?
    } ?>
</div>
