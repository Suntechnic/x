<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

include(__DIR__.'/../.default/result_modifier.php');


$arResult['SORT'] = \App\Catalog\Component::getSort([
        'SORT1'     => $arParams["ELEMENT_SORT_FIELD"],
        'SORT2'     => $arParams["ELEMENT_SORT_FIELD2"],
        'ORDER1'    => $arParams["ELEMENT_SORT_ORDER"],
        'ORDER2'    => $arParams["ELEMENT_SORT_ORDER2"]
    ]);