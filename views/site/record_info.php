<?php if ($record): ?>
    <h2>Информация о записи</h2>
    <table class="record-info">
        <tr>
            <td>ФИО пациента</td>
            <td><?= $patient->surname . ' ' . $patient->name . ' ' . $patient->patronymic ?></td>
        </tr>
        <tr>
            <td>ФИО врача</td>
            <td><?= $doctor->surname . ' ' . $doctor->name . ' ' . $doctor->patronymic ?></td>
        </tr>
        <tr>
            <td>Дата приема</td>
            <td><?= $record->date ?></td>
        </tr>
        <tr>
            <td>Статус</td>
            <td>
                <form method="POST">
                <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">
                    <select class="selectStatus" name="id_status">
                        <?php foreach ($statuses as $status): ?>
                            <option value="<?= $status->id ?>" <?= ($status->id == $record->status_id) ? 'selected' : '' ?>>
                                <?= $status->name ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <input type="hidden" name="record_id" value="<?= $record->id ?>">
                    <button type="submit" class="choice_button">Сменить статус</button>
                </form>
            </td>

        </tr>
    </table>
<?php else: ?>
    <p>Запись не найдена</p>
<?php endif; ?>
