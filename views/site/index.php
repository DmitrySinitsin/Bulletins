<?php

/* @var $this yii\web\View */

$this->title = 'Главная страница';
?>
<div class="site-index">

    <div class="jumbotron">
        <?php foreach ($themes as $theme){
            
        ?>
        <a class="btn btn-info" href="/site/index?id=<?=$theme->id?>" title="<?=$theme->info?>">
            <?=$theme->title ?>
            <span class="badge"><?=$theme->getThemesBullCount() ?></span>
        </a>
        <? } ?>
    </div>

    <div class="body-content">

        <div class="row">
            <?php foreach($bulletins as $bull) { ?>
                <?=$this->render('bulletin',['bull'=>$bull]) ?>
           <? } ?> 
        </div>

    </div>
</div>
