<?php
use Bitrix\Main\Config\Option;
use Bitrix\Main\EventManager;
use Bitrix\Main\Loader;

Loader::includeModule('iblock');

$iblockType = new CIBlockType();
$typeId = 'b24_academy_customs';
$typeCheck = CIBlockType::GetByID($typeId)->Fetch();
if ($typeCheck === false) {
    $typeId = $iblockType->Add([
        'ID' => 'b24_academy_customs',
        'SECTIONS' => 'N',
        'IN_RSS' => 'N',
        'SORT'=> 100,
        'LANG' => [
            'ru'=> [
                'NAME' => 'Академия Битрикс24',
                'ELEMENT_NAME' => 'Факт',
            ],
            'en'=> [
                'NAME' => 'Bitrix24Academy',
                'ELEMENT_NAME' => 'FACT',
            ],
        ],
    ]);
    if(!empty($iblockType->LAST_ERROR)) {
        throw new RuntimeException($iblockType->LAST_ERROR);
    }
}

$iblockManager = new CIBlock();
$idIb =$iblockManager->Add([
    'ACTIVE'=>'Y',
    'API_CODE' => 'companyFacts',
    'NAME' => 'Факты о компании',
    'IBLOCK_TYPE_ID'=> $typeId,
    'LID' => 's1',
    'WORKFLOW'=> 'N',
    'BIZPROC'=>'N',
    'VERSION'=>2,
    'CODE'=>'b24_academy_company_facts'
]);

if (!empty($iblockManager->LAST_ERROR)){
    throw new RuntimeException($iblockManager->LAST_ERROR);
}
\Bitrix\Main\Config\Option::set('b24.academy', 'FACTS_IBLOCK_ID',$idIb);

CopyDirFiles(
    __DIR__ . '/files/components',
    $_SERVER['DOCUMENT_ROOT'] . '/local/components',
    true,
    true
);

CopyDirFiles(
    __DIR__ . '/files/js',
    $_SERVER['DOCUMENT_ROOT'] . '/local/js',
    true,
    true
);

$em->registerEventHandler(
    'main',
    'OnEpilog',
    'b24.academy',
    '\B24\Academy\UI\Menu\LeftMenuExtender',
    'handleOnEpilog'
);

Option::set('b24.academy', 'VERSION', 2025_07_02_15_21_00);