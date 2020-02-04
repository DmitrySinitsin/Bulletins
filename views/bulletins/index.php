<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title='Объявления';
$this->params['breadcrumbs'][]=$this->title;
?>

<div class="row">
    <a class="btn btn-default" href="/bulletins/addbulletin">Добавить объявление</a>
</div>
<div class="row">
    
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#wait" data-toggle='tab'>
                Черновики
            </a>
        </li>
        <li>
            <a href="#public" data-toggle='tab'>
                Опубликованные
            </a>
        </li>
        <li>
            <a href="#deleted" data-toggle='tab'>
                Удаленные
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div id="wait" class="tab-pane fade in active">
            <table class="table table-hover">
                <tr>
                    <th>№</th>
                    <th>Объявление</th>
                    <th>Управление</th>
                </tr>
                <?php foreach ($wait_bulletins as $wait) { ?>
                <tr>
                    <td>
                        <?=$wait->id ?>
                    </td>
                    <td>
                        <?=$wait->title ?>
                    </td>
                    <td>
                        <a class="btn btn-warning" href="/bulletins/addbulletin?id=<?=$wait->id?>">Редактировать</a>
                        <a class="btn btn-danger" href="/bulletins/delete?id=<?=$wait->id?>">Удалить</a>
                        <a class="btn btn-success" href="/bulletins/public?id=<?=$wait->id?>">
                            <i class="glyphicon glyphicon-ok"></i>
                            Опубликовать
                        </a>
                        <a href="/photo/index?id=<?=$wait->id?>" class="btn btn-default">Фото</a>
                        <a class="btn btn-info" href="/bulletins/addtheme?id=<?=$wait->id?>">
                            <i class="glyphicon glyphicon-th-list"></i>
                            Темы
                        </a>
                    </td>
                </tr>
                <? } ?>
            </table>
        </div>
        <div id="public" class="tab-pane fade">
            <table class="table table-hover">
                <tr>
                    <th>№</th>
                    <th>Объявление</th>
                    <th>Управление</th>
                </tr>
                <?php foreach ($public_bulletins as $public) { ?>
                <tr>
                    <td>
                        <?=$public->id ?>
                    </td>
                    <td>
                        <?=$public->title ?>
                    </td>
                    <td>
                        <a class="btn btn-warning" href="/bulletins/addbulletin?id=<?=$public->id?>">Редактировать</a>
                        <a class="btn btn-danger" href="/bulletins/delete?id=<?=$public->id?>">Удалить</a>
                        <a class="btn btn-info" href="/bulletins/wait?id=<?=$public->id?>">
                            Отключить просмотр</a>
                    </td>
                </tr>
                <? } ?>
            </table>
        </div>
        
        <div id="deleted" class="tab-pane fade">
            <table class="table table-hover">
                <tr>
                    <th>№</th>
                    <th>Объявление</th>
                    <th>Управление</th>
                </tr>
                <?php foreach ($delete_bulletins as $del) { ?>
                <tr>
                    <td>
                        <?=$del->id ?>
                    </td>
                    <td>
                        <?=$del->title ?>
                    </td>
                    <td>
                     
                        <a class="btn btn-success" href="/bulletins/wait?id<?=$del->id?>">
                            <i class="glyphicon glyphicon-ok"></i>
                            Восстановить</a>
                    </td>
                </tr>
                <? } ?>
            </table>
        </div>
    </div>
</div>