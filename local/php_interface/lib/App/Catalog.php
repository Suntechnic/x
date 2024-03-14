<?php
namespace App;

class Catalog
{
    public static function getListCatalogProps  () {
        $IblockId = \Bxx\Helpers\IBlocks::getIdByCode('catalog');

        $lstProps = [];
        $rdbProperties = \CIBlockProperty::GetList(
                ['SORT' => 'ASC'],
                [
                        'ACTIVE'    => 'Y',
                        'IBLOCK_ID' => $IblockId,
                    ]
            );
        while($dctProp = $rdbProperties->GetNext()) {
            $lstProps[] = $dctProp['CODE'];
        }

        return $lstProps;
    }



    public static function precachePriceUpdate ($event) {
        $arFields = $event->getParameter('fields');
        if ($arFields['PRODUCT_ID']) {

            // получеаем цену товара... пока без скидки
            $arPrice = \CCatalogProduct::GetOptimalPrice($arFields['PRODUCT_ID'], 1, [1,2,3,4]);

            $PriceValue = $arPrice['DISCOUNT_PRICE'];
            if (!$PriceValue) $PriceValue = $arPrice['PRICE']['PRICE'];
            if (!$PriceValue) $PriceValue = $arFields['PRICE'];

            if ($PriceValue) {
                // получаем торговое предложение
                $rdb = \CIBlockElement::GetList([], [
                        'IBLICK_ID' => \Bxx\Helpers\IBlocks::getIdByCode('offers'),
                        'ID' => $arFields['PRODUCT_ID']
                    ], false, false, ['ID','PROPERTY_CML2_LINK']);
                if ($dctOffer = $rdb->fetch()) { // если оно есть...
                    // получаем соответствующий товра
                    $rdb = \CIBlockElement::GetList([], [
                            'IBLICK_ID' => \Bxx\Helpers\IBlocks::getIdByCode('catalog'),
                            '=ID' => $dctOffer['PROPERTY_CML2_LINK_VALUE']
                        ], false, false, ['ID','IBLOCK_ID','PROPERTY__MINPRICE']);
                    if ($dctGood = $rdb->fetch()) { // если он есть...
                        // проверяем...
                        if (!$dctGood['PROPERTY__MINPRICE_VALUE'] // что минпрайс не установлен...
                                || $dctGood['PROPERTY__MINPRICE_VALUE'] > $PriceValue // или больше этой цены
                            ) {
                            // обновляем минпрайс
                            \CIBlockElement::SetPropertyValuesEx(
                                    $dctGood['ID'], 
                                    $dctGood['IBLOCK_ID'], 
                                    ['_MINPRICE' => $PriceValue]
                                );

                        }
                    }
                }
            }
        }
    }
}
