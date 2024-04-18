<h2>Список записей</h2>
<table class="list-records">
    <tr>
        <td>ФИО пациента</td>
        <td>ФИО врача</td>
        <td>Дата приема</td>
        <td>Статус</td>
        <td>Действия</td>
    </tr>
    <?php foreach ($records as $record): ?>
        <tr>
            <td>
                <?php
                $patient = $user->where('id', $record->id_patient)->first();
                echo $patient->surname . ' ' . $patient->name . ' ' . $patient->patronynic;
                ?>
            </td>
            <td>
                <?php
                $doctor = $doctors->where('id', $record->id_doctor)->first();
                echo $doctor->surname . ' ' . $doctor->name . ' ' . $doctor->patronymic;
                ?>
            </td>
            <td><?= $record->date ?></td>
            <td><?= $record->status->name?? 'Статус не определен' ?></td>
            <td>
                    <form method="GET" action="<?= app()->route->getUrl('/record/' . $record->id) ?>">
                        <button type="submit" class="moreDetails">Подробнее</button>
                        <input type="hidden" name="goToInfoRecord" value="<?= $record->id ?>">
                    </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
