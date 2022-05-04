<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

?><a
        href="<?=str_replace('//','/',str_replace('#SITE_DIR#',SITE_DIR,$arResult['IBLOCK']['LIST_PAGE_URL']))?>"
        title="Нам нужны: <?=implode(', ',array_column($arResult['ITEMS'],'NAME'))?>"
    ><?=\X\Helpers\Html::inclineNum(count($arResult['ITEMS']),[' вакансия', ' вакансии', ' вакансий'], true)?></a>