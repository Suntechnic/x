<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arResult['ITEM'] = $arResult['ITEMS'][0];
unset($arResult['ITEMS']);

$this->__component->setResultCacheKeys(['ITEM']);

foreach ($arResult['ITEM']['PROPERTY_CSS_VALUE'] as $i=>$file_id) {
    $arResult['ITEM']['PROPERTY_CSS_PATH'][$i] = \CFile::getPath($file_id);
}

foreach ($arResult['ITEM']['PROPERTY_JS_VALUE'] as $i=>$file_id) {
    $arResult['ITEM']['PROPERTY_JS_PATH'][$i] = \CFile::getPath($file_id);
}

if ($arResult['ITEM']['PROPERTY_HTML_VALUE']) {
    $arResult['ITEM']['PROPERTY_HTML_PATH'] = \CFile::getPath($arResult['ITEM']['PROPERTY_HTML_VALUE']);
}






// получим следующий элемент
# http://dev.1c-bitrix.ru/api_help/iblock/classes/ciblockelement/getlist.php

$arSelect = Array(
        'IBLOCK_ID',
        'ID',
        'CODE',
        'DETAIL_PAGE_URL'
    );
$arFilter = $this->getComponent()->getFilter();

$db_res = CIBlockElement::GetList($arResult['SORT'], $arFilter, false, ['nElementID'=>$arResult['ITEM']['ID'],'nPageSize'=>1], $arSelect);
$dctNextElement = false;
while($arElement = $db_res->getNext()) $dctNextElement = $arElement;

if ($dctNextElement['ID'] == $arResult['ITEM']['ID']) { // мы на последнем элементе - нужно выбрать первый
    $db_res = CIBlockElement::GetList($arResult['SORT'], $arFilter, false, ['nTopCount'=>1], $arSelect);
    if ($arElement = $db_res->getNext()) $dctNextElement = $arElement;
}

$arResult['NEXT_ITEM'] = $dctNextElement;
