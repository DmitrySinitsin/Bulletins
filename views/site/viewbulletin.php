<div class="row">
    <div class="col-lg-6 col-md-6">
        <div class="row">
            <a class="btn btn-default" title="Вернуться на предыдущую страницу" href="<?= $prev_url ?>">
                Вернуться на предыдущую страницу
            </a>
            <h3><?= $bulletin->title ?></h3>
            <p><img src='/<?= $bulletin->getAvatar() ?>' alt="ava" id="bullavatar" style="height: 270px"></p>
        </div>
        <div class="row">
            <?php foreach ($bulletin->photo as $photo) { ?>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <img src="/<?= $photo->link ?>" alt="photo" class="thumbnail bullphotos" title="<?= $photo->info ?>">
                </div>
                <? }?>

            </div>
            <div class="row">

                <?php foreach ($bulletin->themesbulletins as $thb) { ?>
                    <a class="btn btn-primary" href="/site/index?id=<?= $thb->themes->id ?>">
                        # <?= $thb->themes->title ?>
                    </a>
                <?php } ?>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">

            <div class="panel panel-info">
                <div class="panel-heading">
                    <i class="glyphicon glyphicon-hand-down"></i>
                    Информация
                </div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <td>Цена</td>
                            <td><strong><?= $bulletin->price ?></strong></td>
                        </tr>
                        <tr>
                            <td>Город</td>
                            <td><strong><?= $bulletin->city ?></strong></td>
                        </tr>
                        <tr>
                            <td>Контакты</td>
                            <td><strong><?= $bulletin->contacts ?></strong></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <?= $bulletin->info ?>
            </div>
            <div class="row">
                <hr> 
                Дата публикации: <span class="badge"><?= $bulletin->date_pub ?></span>
        </div>
    </div>
</div>




