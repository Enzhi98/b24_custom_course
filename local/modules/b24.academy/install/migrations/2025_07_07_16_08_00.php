<?php
use Bitrix\Main\Config\Option;
use Bitrix\Main\EventManager;
use B24\Academy\UserField\CurrencyField;
use Bitrix\Main\IO\Path;

CopyDirFiles(
    dirname(__DIR__) . '/../components/b24.academy',
    $_SERVER['DOCUMENT_ROOT'] . '/local/components/b24.academy/',
    true,
    true
);

CopyDirFiles(
    dirname(__DIR__) . '/../templates/.default/components/bitrix/crm.field.filter',
    $_SERVER['DOCUMENT_ROOT'] . '/local/templates/.default/components/bitrix/crm.field.filter',
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

Option::set('b24.academy', 'VERSION', 2025_07_07_16_08_00);