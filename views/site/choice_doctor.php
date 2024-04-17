<h2>Выбор врача</h2>
<form method="POST">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
    <label>Выбрать пациента<br>
        <select name="patient_id">
            <?php
            foreach ($patients as $patient) {
                $patientFullName = $patient->name . ' ' . $patient->surname;
                echo "<option value='$patient->id'>$patientFullName</option>";
            }
            ?>
        </select>
    </label><br>
    <button>Показать врачей</button>
</form>

<?php
if (isset($doctors)) {
    if (count($doctors) > 0) {
        echo "<h4>Врачи, к которым записан выбранный пациент:</h4>";
        foreach ($doctors as $doctor) {
            echo "<p>ФИО врача: $doctor->full_name</p>";
            // Здесь можно вывести другие данные о враче, если необходимо
        }
    } else {
        echo "<h4>У этого пациента отсутствуют записи к врачам</h4>";
    }
}
?>