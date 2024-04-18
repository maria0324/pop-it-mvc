<h2>Выбор врача</h2>
<div class="choice_doctor">
    <form method="POST">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <label>Выбрать пациента<br>
            <select class="selectType" name="patient_id">
                <?php
                foreach ($patients as $patient) {
                    $patientFullName = $patient->name . ' ' . $patient->surname;
                    echo "<option value='$patient->id'>$patientFullName</option>";
                }
                ?>
            </select>
        </label><br>
        <button class="choice_button">Показать врачей</button>
</form>
</div>
<?php
if (isset($doctors)) {
    if (count($doctors) > 0) {
        echo "<h4>Врачи, к которым записан выбранный пациент:</h4>";
        foreach ($doctors as $doctor) {
            echo "<p>ФИО врача: $doctor->full_name</p>";
        }
    } else {
        echo "<h4>У этого пациента отсутствуют записи к врачам</h4>";
    }
}
?>