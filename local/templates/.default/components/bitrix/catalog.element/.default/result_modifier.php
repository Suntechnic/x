<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();


$rdb = \CIBlockElement::GetList([], [
        'IBLOCK_ID'=> \Bxx\Helpers\IBlocks::getIdByCode('news'),
        'PROPERTY_SEO_RELATED' => $arResult['ID'],
        'ACTIVE_DATE' => 'Y',
        'ACTIVE'=>'Y'
    ], false, false, ['ID']);
while($dctNewsElement = $rdb->fetch()) {
    $arResult['NEWS'][] = $dctNewsElement['ID'];
}


///\Kint\Kint::dump($arResult['NEWS']);