<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\bootstrap\ActiveForm;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '<img src="/logo.png" alt="home" class="logo pull-left">'.Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
            'id'=>'bulltopmenu',
        ],
    ]);
    
    ActiveForm::begin([
        'action'=>['site/search'],
        'method'=>'get',
        'options'=>
        [
            'class'=>'navbar-form navbar-left'
        ]
    ]);
    
    echo Html::input($type='text',
                            'search',
                            '',
                            [
                                'placeholder'=>'Найти...',
                                'class'=>'form-control'
                            ]
            );
    
    ActiveForm::end();
    
    echo Nav::widget([
        'options'=>['class'=>'navbar-nav navbar-left'],
        'items'=>[
            [
                'label'=>'','url'=>['#'],'items'=>
                [
                    ['label'=>'Расширенный поиск','url'=>['/site/advsearch'],]
                ],
            ],
        ],
    ]);
            
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label'=>'Администрирование','url'=>['*'],'visible'=>!Yii::$app->user->isGuest,
                'items'=>
                [
                    ['label'=>'Мои объявления','url'=>['/bulletins/index'],'visible'=>!Yii::$app->user->isGuest],
                    ['label'=>'Справочник тем','url'=>['/themes/index'], 'visible'=>!Yii::$app->user->isGuest],
                ],
            ],
            
            ['label' => 'Обратная связь', 'url' =>['/site/contact'], 
                'visible'=>!Yii::$app->user->isGuest],
            
            ['label' => 'Регистрация', 'url' => ['/user/add'], 'visible'=>Yii::$app->user->isGuest],
            Yii::$app->user->isGuest ? (
                ['label' => 'Вход', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Выход (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        
        <?= Alert::widget() ?>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        
        
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Dmitry Sinitsin <?= date('Y') ?></p>

        <p class="pull-right">Kirov, USSR</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
