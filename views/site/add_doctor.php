<div class="add-doctor-container">
    <h2>Добавление врача</h2>

    <form method="post">
        <label>Фамилия <input type="text" name="surname"></label>
        <label>Имя <input type="text" name="name"></label>
        <label>Отчетсво <input type="text" name="patronymic"></label>
        <label>Адрес <input type="text" name="address"></label>
        <label>Номер телефона <input type="text" name="number"></label>
        <label>Должность </label>
        <select class="selectType" name="id">
            <?php
            foreach($posts as $post) {
                echo  "<option label=' $post->name  ' <?= $post->id ?></option>";
            }
            ?>
        </select>
        <label>Специализация</label>
        <select class="selectType" name="id">
        <?php
        foreach($specialities as $speciality) {
            echo  "<option label=' $speciality->name  ' <?= $speciality->id ?></option>";
        }
        ?>
        </select>
        <button>Добавить</button>
    </form>

</div>
