<div class="row">
    <a class="btn btn-default" href="/themes/add">
        <i class="glyphicon glyphicon-plus"></i>
        Добавить тему
    </a>
</div>
<div class="row">
    <table class="table table-hover">
        <tr>
            <th>Тема</th>
            <th>Управление</th>
        </tr>
        <?php foreach ($themes as $theme) { ?>
        <tr>
            <td><?=$theme->title ?></td>
            <td>
                <a class="btn btn-warning" href="/themes/add?id=<?=$theme->id?>" title="Редактировать тему">
                    <i class="glyphicon glyphicon-edit"></i>
                </a>
                <a class="btn btn-danger" href="/themes/deletequery?id=<?=$theme->id?>" title="Удалить тему">
                    <i class="glyphicon glyphicon-remove"></i>
                </a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>