<h2>Выбор записей</h2>
<form method="POST">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
    <label>Выбрать пациента<br>
        <select name="patient_id">
            <?php

            foreach ($patients as $patient) {
                $patientFullName = $patient->name . ' ' . $patient->surname;
                echo "<option label='$patientFullName'> $patient->id </option>";
            }

            ?>
        </select>
    </label><br>
    <button>Показать записи</button>
</form>

<?php
if (isset($records)) {
    foreach ($records as $record) {
        echo "<p>Запись номер $record->id</p>";
        echo "<p>ид врача: $record->id_doctor</p>";
        echo "<p>Дата записи: $record->date</p>";
    }
} else echo "<h4>У этого пациента отсутствуют записи</h4>";
