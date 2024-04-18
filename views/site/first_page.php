<h2>Добро пожаловать в нашу клинику!</h2>

<form method="post" enctype="multipart/form-data" class="form_photo">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
    <input type="file" name="image">
    <button type="submit" class="form_photo_button">Загрузить изображение</button>
</form>

<?php if ($images->isNotEmpty()): ?>
    <?php foreach ($images as $image): ?>
        <img src="/../pop-it-mvc/public/img/<?= $image->name ?>" class="photos" alt="Изображение">
    <?php endforeach; ?>
<?php endif; ?>