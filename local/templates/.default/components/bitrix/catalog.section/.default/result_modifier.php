<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

foreach ($arResult['ITEMS'] as $ItemI => $dctItem) { 
    // определение минимальной цены
    $MinPriceI = -1;
    $CheepedOffersI = -1;
    foreach ($dctItem['OFFERS'] as $OfferI=>$dctOffer) {
        foreach ($dctOffer['ITEM_PRICES'] as $PriceI=>$arPrice) {
            if (($MinPriceI < 0 && $CheepedOffersI < 0) 
                    || $dctItem['OFFERS'][$CheepedOffersI]['ITEM_PRICES'][$MinPriceI]['PRICE'] > $arPrice['PRICE']
                ) {
                $MinPriceI = $PriceI;
                $CheepedOffersI = $OfferI;
            }
        }
    }
    $arResult['ITEMS'][$ItemI]['MIN_PRICE_INDEX'] = [
            'OFFER' => $CheepedOffersI,
            'PRICE' => $MinPriceI
        ];
    // \Kint\Kint::dump($arResult['ITEMS'][$ItemI]);
    // break;
}
