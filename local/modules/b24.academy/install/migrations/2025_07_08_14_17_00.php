<?php
use Bitrix\Main\Config\Option;
use Bitrix\Main\EventManager;
use B24\Academy\UserField\CurrencyField;
use Bitrix\Main\IO\Path;

$sourcePath1 = dirname(__DIR__) . '/files/components/b24.academy/';
$targetPath1 = $_SERVER['DOCUMENT_ROOT'] . '/local/components/b24.academy/';
$sourcePath2 = dirname(__DIR__) . '/templates/.default/components/bitrix/crm.field.filter';
$targetPath2 = $_SERVER['DOCUMENT_ROOT'] . '/local/templates/.default/components/bitrix/crm.field.filter';
if (!is_dir($sourcePath1)) {
    die('Ошибка: Исходная папка не найдена: ' . $sourcePath1);
}

if (!is_dir($sourcePath2)) {
    die('Ошибка: Исходная папка не найдена: ' . $sourcePath2);
}

CopyDirFiles(
    Path::combine($sourcePath1),
    Path::convertRelativeToAbsolute($targetPath1),
    true,
    true
);

CopyDirFiles(
    Path::combine($sourcePath2),
    Path::convertRelativeToAbsolute($targetPath2),
    true,
    true
);

$eventManager = EventManager::getInstance();
$eventManager->registerEventHandlerCompatible(
    'main',
    'OnUserTypeBuildList',
    'b24.academy',
    CurrencyField::class,
    'getUserTypeDescription'
);

Option::set('b24.academy', 'VERSION', 2025_07_08_14_17_00);