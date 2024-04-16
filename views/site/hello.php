<?php
if (!app()->auth::checkRole()):
    ?>
    <div class="h-patient">
        <h2>Пациент</h2>
    </div>
    <div class="a-patient">
        <a href="<?= app()->route->getUrl('/add_patient') ?>">Добавить пациента</a>
        <a href="<?= app()->route->getUrl('/patient') ?>">Список пациентов</a>

    </div>

    <div class="h-doctor">
        <h2>Врач</h2>
    </div >
    <div class="a-doctor">
        <a href="<?= app()->route->getUrl('/add_doctor') ?>">Добавить врача</a>
        <a href="<?= app()->route->getUrl('/doctor') ?>">Список врачей</a>
    </div>

    <div class="h-notes">
        <h2>Записи</h2>
    </div>
    <div class="a-notes">
        <a href="<?= app()->route->getUrl('/add_reseption') ?>">Запись на прием</a>
        <a href="<?= app()->route->getUrl('/record') ?>">Список записей</a>
        <a href="<?= app()->route->getUrl('/choice_record') ?>">Выбрать все записи по пациентам</a>
        <a href="<?= app()->route->getUrl('/choice_patient') ?>">Выбрать всех пациентов записанных к врачу</a>
        <a href="<?= app()->route->getUrl('/choice_doctor') ?>">Выбрать всех врачей, к которым записан пациент.</a>
    </div>
<?php else: ?>
    <a href="<?= app()->route->getUrl('/admin') ?>">Продолжить как администратор</a>
<?php endif ?>


