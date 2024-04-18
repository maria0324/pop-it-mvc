<?php if (!empty($patients)): ?>
    <h3>Результаты поиска:</h3>
    <ul>
        <?php foreach ($patients as $patient): ?>
            <li><?= $patient->surname . ' ' . $patient->name . ' ' . $patient->patronymic ?></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <h2>Вывод пациента по врачу и дате</h2>
<?php endif; ?>

<form method="POST">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
    <label>Выберите врача<br>
        <select class="selectType" name="doctor_id">
            <?php foreach ($doctors as $doctor): ?>
                <option value="<?= $doctor->id ?>"><?= $doctor->surname . ' ' . $doctor->name . ' ' . $doctor->patronymic ?></option>
            <?php endforeach; ?>
        </select>
    </label><br>
    <label>Введите дату и время <br>
        <input type="datetime-local" name="date">
    </label><br>
    <button class="choice_button">Найти пациентов</button>
</form>
