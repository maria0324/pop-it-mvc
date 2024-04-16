<div class="add-record-container">
    <h2>Запись на прием</h2>

    <form method="post">
        <div class="size_block">


            <label>Врач</label>
            <select class="selectType" name="id">
                <?php
                    foreach($doctors as $doctor) {
                        echo  "<option label=' $doctor->surname $doctor->name $doctor->patronymic' <?= $doctor->id ?></option>";
                        }
                    ?>
            </select>


            <label>Пациент </label>
            <select class="selectType" name="id">
                <?php
                foreach($patients as $patient) {
                    echo  "<option label=' $patient->surname $patient->name $patient->patronymic' <?= $patient->id ?></option>";
                }
                ?>
            </select>

            <label>Дата и время приема <input type="datetime-local" name="login"></label>

        </div>
        <button>Добавить</button>
    </form>

</div>
