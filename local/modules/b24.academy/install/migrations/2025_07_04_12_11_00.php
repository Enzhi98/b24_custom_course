<?php
use Bitrix\Main\Config\Option;
use Bitrix\Main\EventManager;

CopyDirFiles(
    dirname(__DIR__) . '/files/components',
    $_SERVER['DOCUMENT_ROOT'] . '/local/components',
    true,
    true
);

CopyDirFiles(
    dirname(__DIR__) . '/files/js',
    $_SERVER['DOCUMENT_ROOT'] . '/local/js',
    true,
    true
);

$eventManager = EventManager::getInstance();
$eventManager->registerEventHandler(
    'main',
    'OnEpilog',
    'b24.academy',
    '\B24\Academy\UI\Menu\LeftMenuExtender',
    'handleOnEpilog'
);

Option::set('b24.academy', 'VERSION', 2025_07_04_12_11_00);