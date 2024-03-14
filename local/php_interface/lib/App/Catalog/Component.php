<?php
namespace App\Catalog;

class Component
{
    public static function sortsList  (): array
    {
        return [
                [
                        'CODE' => 'featured',
                        'TITLE' => 'Featured',
                        'SORT1' => 'SORT',
                        'ORDER1' => 'ASC',
                        'SORT2' => 'ID',
                        'ORDER2' => 'DESC',
                    ],
                [
                        'CODE' => 'expensive',
                        'TITLE' => 'Expensive',
                        'SORT1' => 'PROPERTY__MINPRICE',
                        'ORDER1' => 'DESC',
                        'SORT2' => 'SORT',
                        'ORDER2' => 'ASC',
                    ],
                [
                        'CODE' => 'cheaper',
                        'TITLE' => 'Cheaper',
                        'SORT1' => 'PROPERTY__MINPRICE',
                        'ORDER1' => 'ASC',
                        'SORT2' => 'SORT',
                        'ORDER2' => 'ASC',
                    ],
            ];
    }

    public static function getSort  ($mixSort=''): array
    {
        $lstSorts = self::sortsList();
        if (is_string($mixSort)) {
            foreach ($lstSorts as $dctSort) {
                if ($dctSort['CODE'] == $mixSort) {
                    $dctSort['ACTIVE'] = 'Y';
                    return $dctSort;
                }
            }
        } elseif (is_array($mixSort)) {
            foreach ($lstSorts as $dctSort) {
                if (
                        $dctSort['SORT1'] == $mixSort['SORT1']
                        && $dctSort['SORT2'] == $mixSort['SORT2']
                        && $dctSort['ORDER1'] == $mixSort['ORDER1']
                        && $dctSort['ORDER2'] == $mixSort['ORDER2']
                    ) {
                    $dctSort['ACTIVE'] = 'Y';
                    return $dctSort;
                }
            }
        }
        

        return $lstSorts[0];
    }



    public static function getParams  (string $Type='list') {
        $IblockId = \Bxx\Helpers\IBlocks::getIdByCode('catalog');

        return [
                'IBLOCK_ID' => $IblockId,
                'IBLOCK_TYPE' => 'catalog',
                'CACHE_FILTER' => 'N',
                'CACHE_GROUPS' => 'Y',
                'CACHE_TIME' => 36000000,
                'CACHE_TYPE' => APPLICATION_ENV=='dev'?'N':'A',
                //'PROPERTY_CODE' => свойства используемм из настроек компонента
                'OFFERS_FIELD_CODE' => [],
                'OFFERS_PROPERTY_CODE' => ['SIZE'],
                'OFFER_TREE_PROPS' => ['SIZE'],
                'OFFERS_CART_PROPERTIES' => ['SIZE'],
                'PRICE_CODE' => ['BASE'],
                'PRICE_VAT_INCLUDE' => 'Y',
                'CURRENCY_ID' => 'USD'
            ];
    }

}
