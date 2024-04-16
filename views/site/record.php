<h1>Список записей</h1>
<table class="list-records">
    <tr>
        <td>ФИО пациента</td>
        <td>ФИО врача</td>
        <td>Дата приема</td>
        <td>Статус</td>
    </tr>
    <?php foreach ($user as $record): ?>
    <tr>
        <td><?= $record->surname ?> <?= $record->name ?> <?= $record->patronynic ?></td>
        <td><?= $record->doctor->surname ?> <?= $record->doctor->name ?> <?= $record->doctor->patronymic ?></td>
        <td><?= $record->date ?></td>
        <td>
            <select class="selectType" name="id">
                <?php foreach($statuses as $status): ?>
                    <option value="<?= $status->id ?>" <?= $status->id == $record->id_status ? 'selected' : '' ?>>
                        <?= $status->name ?>
                    </option>
                <?php endforeach; ?>

            </select>
        </td>
    </tr>
    <?php endforeach; ?>

</table>