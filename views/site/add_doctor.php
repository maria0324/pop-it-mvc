<div class="add-doctor-container">
    <h2>Добавление врача</h2>

    <form method="post">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <label>Фамилия <input type="text" name="surname"></label>
        <label>Имя <input type="text" name="name"></label>
        <label>Отчество <input type="text" name="patronymic"></label>
        <label>Адрес <input type="text" name="address"></label>
        <label>Номер телефона <input type="text" name="number"></label>
        <label>Должность </label>
        <select class="selectType" name="id_post">
            <?php
            foreach($posts as $post) {
                echo  "<option label=' $post->name  ' value=' $post->id  '</option>";
            }
            ?>
        </select>
        <label>Специализация</label>
        <select class="selectType" name="id_speciality">
            <?php
            foreach($specialities as $speciality) {
                echo  "<option label=' $speciality->name  ' value='$speciality->id'</option>";
            }
            ?>
        </select>
        <button>Добавить</button>
    </form>

</div>