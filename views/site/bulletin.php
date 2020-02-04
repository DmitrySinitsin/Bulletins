<div class="col-sm-6 col-md-4 col-lg-3">
    
    <a href="/site/view-bulletin?id=<?= $bull->id ?>" class="thumbnail">
        <img src='/<?= $bull->getAvatar() ?>' style="height:200px" alt="no" title="Подробнее">
    </a>
    <p><?= $bull->title ?></p>
    <p>Цена: <strong><?= $bull->price ?></strong></p>
    <p>Город: <strong><?= $bull->city ?></strong></p>
    <p>Дата публикации: <span class="badge"><?=$bull->date_pub ?></span></p>
</div>