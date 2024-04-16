<h1>Список Врачей</h1>
<table class="list-doctors">
    <tr>
        <td>ID врача</td>
        <td>Фамилия</td>
        <td>Имя</td>
        <td>Отчество</td>
        <td>Адрес</td>
        <td>Номер телефона</td>
        <td>Должность</td>
        <td>Специализация</td>
    </tr>
    <?php foreach ($doctors as $doctor): ?>
        <tr>
            <td><?= $doctor->id ?></td>
            <td><?= $doctor->surname ?></td>
            <td><?= $doctor->name ?></td>
            <td><?= $doctor->patronymic ?></td>
            <td><?= $doctor->address ?></td>
            <td><?= $doctor->number ?></td>
            <td><?= $doctor->id_post ?></td>
            <td><?= $doctor->id_speciality ?></td>
        </tr>
    <?php endforeach; ?>
</table>