<?php
use Bitrix\Main\Config\Option;
use Bitrix\Main\EventManager;

CopyDirFiles(
    dirname(__DIR__) . '/files/css',
    $_SERVER['DOCUMENT_ROOT'] . '/local/css',
    true,
    true
);

$eventManager = EventManager::getInstance();
$eventManager->registerEventHandler(
    'main',
    'OnEpilog',
    'b24.academy',
    '\B24\Academy\UI\Tasks\ListPageMutator',
    'handleOnEpilog'
);
Option::set('b24.academy', 'VERSION', 2025_07_02_14_19_00);
