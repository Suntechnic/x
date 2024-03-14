<?php
// создаем карту
$arResult['MAP'] = \Bxx\Helpers\IBlocks\Sections\Modifiers::maper($arResult['ITEMS']);

foreach ($arResult['ITEMS'] as $I=>$dctItem) {
    if ($dctItem['IBLOCK_SECTION_ID']) {
        $ParentI = $arResult['MAP'][$dctItem['IBLOCK_SECTION_ID']];
        $arResult['ITEMS'][$ParentI]['CHILDS_ID'][] = $dctItem['ID'];
    }
}
