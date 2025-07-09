<?php
use Bitrix\Main\Config\Option;
use Bitrix\Main\EventManager;
use B24\Academy\UserField\CurrencyField;
use Bitrix\Main\IO\Path;


$sourcePath2 = dirname(__DIR__) . '/templates/.default/components/bitrix/crm.field.filter';
$targetPath2 = '/local/templates/.default/components/bitrix/crm.field.filter';


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

$eventManager = EventManager::getInstance();
$eventManager->registerEventHandlerCompatible(
    'main',
    'OnUserTypeBuildList',
    'b24.academy',
    CurrencyField::class,
    'getUserTypeDescription'
);

Option::set('b24.academy', 'VERSION', 2025_07_08_15_35_00);