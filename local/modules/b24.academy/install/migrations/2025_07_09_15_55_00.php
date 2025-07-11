<?php
use Bitrix\Main\Config\Option;
use Bitrix\Main\EventManager;
use B24\Academy\UserField\CurrencyField;
use Bitrix\Main\IO\Path;


$sourcePath2 =dirname(__DIR__) . '/files/activities/';
$targetPath2 = '/local/activities/';

echo 'Откуда копируем:' . $sourcePath2 . '\n';
echo 'Куда копируем:' . $targetPath2 . '\n';
if (!is_dir($sourcePath2)) {
    die('Ошибка: Исходная папка не найдена: ' . $sourcePath2);
}

echo 'Откуда копируем:' . $sourcePath2;
echo 'Куда копируем:' . $targetPath2;

CopyDirFiles(
        Path::combine($sourcePath2),
        Path::convertRelativeToAbsolute($targetPath2),
    true,
    true
);

Option::set('b24.academy', 'VERSION', 2025_07_09_15_55_00);