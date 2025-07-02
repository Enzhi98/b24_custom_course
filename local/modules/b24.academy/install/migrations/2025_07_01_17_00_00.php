<?php

use B24\Academy\UI\Tasks\ListPageMutator;
use Bitrix\Main\Config\Option;

CopyDirFiles(
    dirname(__DIR__) . '/files/css',
    $_SERVER['DOCUMENT_ROOT'] . '/local/css',
    true,
    true
);

    $em->registerEventHandler(
        'main',
        'OnEpilog',
        'b24.academy',
        ListPageMutator::class,
        'handlerOnEpilog'
    );
Option::set('b24.academy', 'VERSION', 2025_07_01_17_00);