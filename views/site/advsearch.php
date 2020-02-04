<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;

$this->title="Расширенный поиск";
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form=ActiveForm::begin() ?>
<div class="row">
    <div class="col-lg-6 col-md-6">
        <h4>Дата публикации</h4>
        <?=$form->field($adv,'date_pub_n')
                ->widget(DatePicker::className(),['language'=>'ru',
                                                  'class'=>'form-control',
                                                  'dateFormat'=>'yyyy-MM-dd'])
                ->label('от')
        ?>
        <?=$form->field($adv,'date_pub_o')
                ->widget(DatePicker::className(),['language'=>'ru',
                                                  'class'=>'form-control',
                                                  'dateFormat'=>'yyyy-MM-dd'])
                ->label('до')
        ?>
        
        <?=$form->field($adv,'title')
                ->textInput(['class'=>'form-control','placeholder'=>'search...'])
                ->label('Заголовок') ?>
   
        <?=$form->field($adv,'info')
                ->textInput(['class'=>'form-control','placeholder'=>'search...'])
                ->label('Информация') ?>
      
        <?=$form->field($adv,'city')
                ->textInput(['class'=>'form-control','placeholder'=>'search...'])
                ->label('Город') ?>
        
        <?=$form->field($adv,'contacts')
                ->textInput(['class'=>'form-control','placeholder'=>'search...'])
                ->label('Контакты') ?>
        
        <?=Html::submitButton('Выборка', ['class'=>'btn btn-primary']) ?>
    </div>
    <div class="col-lg-6 col-md-6">
        <div>
            <h4>Цена</h4>
            <ul class="nav nav-pills">
                <li class="nav-item <?php
                    echo ($adv->pills_=="1" ? 'active' : '')
                ?> priceselect" data-id='1'>
                    <a href="#" class="nav-link">
                        Точное значение
                    </a>
                </li>
                <li class="nav-item <?php
                    echo ($adv->pills_=="2" ? 'active' : '')
                ?> priceselect" data-id='2'>
                    <a href="#" class="nav-link">
                        Диапазон
                    </a>
                </li>
                <li class="nav-item <?php
                    echo ($adv->pills_=="3" ? 'active' : '')
                ?> priceselect" data-id='3'>
                    <a href="#" class="nav-link">
                        Больше... меньше
                    </a>
                </li>
            </ul>
        </div>
        <div class="priceblock" data-id='1'>
            <?=$form->field($adv,'price')->textInput(['class'=>'form-control','placeholder'=>'0']) 
                    ->label('Точное значение') ?>
        </div>
        <div class="priceblock" data-id='2'>
            <?=$form->field($adv,'price_from')->textInput(['class'=>'form-control','placeholder'=>'0']) 
                    ->label('от') ?>
            <?=$form->field($adv,'price_to')->textInput(['class'=>'form-control','placeholder'=>'100']) 
                    ->label('до') ?>
        </div>
        <div class="priceblock" data-id='3'>
            <?=Html::radio('sign',($adv->radio_=="1" ? true : false),['label'=>'Больше','value'=>'1']) ?>
            <?=Html::radio('sign',($adv->radio_=="2" ? true : false),['label'=>'Меньше','value'=>'2']) ?>
            <?=$form->field($adv,'price_more')->textInput(['class'=>'form-control','placeholder'=>'0']) 
                    ->label('') ?>
        </div>
    </div>
</div>

<?php ActiveForm::end() ?>

<?php if($bulletins!=null) { ?>
<h3>Результаты поиска</h3>
    <div class="row">
                <?php foreach($bulletins as $bull) { ?>
                    <?=$this->render('bulletin',['bull'=>$bull]) ?>
               <? } ?> 
    </div>
<? } ?>
