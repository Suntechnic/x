<?php
include(__DIR__.'/../news/result_modifier.php');
$arResult['ITEM'] = $arResult['ITEMS'][0];

$ipropSectionValues = new \Bitrix\Iblock\InheritedProperty\ElementValues($arResult['ITEM']['IBLOCK_ID'], $arResult['ITEM']['ID']);
$arResult['ITEM']['SEO'] = $ipropSectionValues->getValues();

$this->__component->setResultCacheKeys(['ITEM']);