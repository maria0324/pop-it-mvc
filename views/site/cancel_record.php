<?php

// Подключение автозагрузчика Composer
require_once __DIR__ . '/vendor/autoload.php';

use Model\Record;

// Получаем идентификатор записи из запроса
$recordId = $_GET['id'] ?? null;

// Проверяем, был ли передан идентификатор записи
if ($recordId !== null) {
    // Находим запись по идентификатору
    $record = Record::find($recordId);

    // Проверяем, найдена ли запись
    if ($record !== null) {
        // Удаляем запись
        $record->delete();

        // Перенаправляем пользователя на страницу со списком записей
        header('Location: /record');
        exit;
    } else {
        // Если запись не найдена, выводим сообщение об ошибке
        echo 'Запись не найдена.';
    }
} else {
    // Если идентификатор записи не был передан, выводим сообщение об ошибке
    echo 'Идентификатор записи не указан.';
}
