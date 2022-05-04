<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach ($arResult['ITEMS'] as $i=>$dctItem) {
    $arResult['ITEMS'][$i]['PROPERTY_LOGO_VALUE'] = \CFile::GetFileArray($dctItem['PROPERTY_LOGO_VALUE']);
}

