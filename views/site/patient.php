<h1>Список пациентов</h1>
<table class="list-patients">
    <tr>
        <td>ID пациента</td>
        <td>Фамилия</td>
        <td>Имя</td>
        <td>Отчество</td>
        <td>Пол</td>
        <td>Адрес</td>
        <td>Номер телефона</td>
        <td>Дата рождения</td>
        <td>Номер полиса</td>
    </tr>
    <?php foreach ($patients as $patient): ?>
        <tr>
            <td><?= $patient->id ?></td>
            <td><?= $patient->surname ?></td>
            <td><?= $patient->name ?></td>
            <td><?= $patient->patronynic ?></td>
            <td><?= $patient->gender ?></td>
            <td><?= $patient->address ?></td>
            <td><?= $patient->number ?></td>
            <td><?= $patient->date_birth ?></td>
            <td><?= $patient->polis ?></td>
        </tr>
    <?php endforeach; ?>
</table>