

<div class="add-doctor-container">
    <h2>Добавление пациента</h2>

    <form method="post">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <label>Фамилия <input type="text" name="surname"></label>
        <label>Имя <input type="text" name="name"></label>
        <label>Отчество <input type="text" name="patronymic"></label>
        <label>Пол <input type="text" name="gender"></label>
        <label>Адрес <input type="text" name="address"></label>
        <label>Номер телефона <input type="text" name="numder"></label>
        <label>Дата рождения <input type="date" name="date_birth"></label>
        <label>Номер полиса <input type="text" name="polis"></label>

        <button>Добавить</button>
    </form>
</div>