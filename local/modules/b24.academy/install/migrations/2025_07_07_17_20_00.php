<?php
use Bitrix\Main\Config\Option;
use Bitrix\Main\EventManager;
use B24\Academy\UserField\CurrencyField;
use Bitrix\Main\IO\Path;

$sourcePath = dirname(__DIR__) . '/files/components/b24.academy/';

// Путь к целевой папке (куда копируем)
$targetPath = $_SERVER['DOCUMENT_ROOT'] . '/local/components/b24.academy/';

// Проверяем существование исходной папки
if (!is_dir($sourcePath)) {
    die('Ошибка: Исходная папка не найдена: ' . $sourcePath);
}

// Создаем целевую папку если не существует
if (!is_dir($targetPath)) {
    mkdir($targetPath, 0755, true);
}

// Выполняем копирование
CopyDirFiles(
    $sourcePath,
    $targetPath,
    true,  // перезаписывать существующие файлы
    true   // копировать рекурсивно (включая подпапки)
);

echo "Копирование успешно выполнено!";;

Option::set('b24.academy', 'VERSION', 2025_07_07_16_51_00);