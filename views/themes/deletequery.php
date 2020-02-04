<div class="jumbotron">
    <div class="row">
        <h3>Вы действительно хотите удалить запись: </h3>
    </div>
    <div class="row">
        <p>Тема: <strong><?=$theme->title ?></strong></p>
        <p>Информация: <strong><?=$theme->info ?></strong></p>
    </div>
    <div class="row">
        <a class="btn btn-danger" href="/themes/delete?id=<?=$theme->id ?>">
            <i class="glyphicon glyphicon-remove"></i> Удалить
        </a>
        <a class="btn btn-default" href="<?=$prev_url ?>">
            Отменить
        </a>
    </div>
</div>
