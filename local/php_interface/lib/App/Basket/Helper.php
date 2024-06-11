<?php
declare(strict_types=1);

namespace App\Basket;

class Helper {
    /* возвращает item'ы корзины*/
    public static function getItems ($basket): array
    {
        $basketItems = $basket->getBasketItems();

        $items = [];

        foreach ($basketItems as $basketItem) {
            $basketPropertyCollection = $basketItem->getPropertyCollection();

            $properties = $basketPropertyCollection->getPropertyValues();
            //unset($properties['PRODUCT.XML_ID'], $properties['CATALOG.XML_ID']);

            $Price = $basketItem->getPrice();
            $Quantity = $basketItem->getQuantity();
            $Sum = $Price*$Quantity;
            $items[] = [
                    'name' => $basketItem->getField('NAME'),
                    'id' => $basketItem->getId(),
                    'productid' => $basketItem->getProductId(),
                    'price' => $Price,
                    'priceformated' => $Price > 0 ? CurrencyFormat($Price, 'USD') : '',
                    'sum' => $Sum,
                    'sumformated' => $Sum > 0 ? CurrencyFormat($Sum, 'USD') : '',
                    'quantity' => $Quantity,
                    'properties' => $properties
                ];
        }
        return $items;
    }
    #

    /*
     * подпись корзины - изменяется при смене состава
     * вторым параметром передаются элементы для сокращения манипуляций
    */
    public static function hash ($basket, $lstItems=false, array $lstCoupons=[]): string
    {
        if ($lstItems === false) $lstItems = self::getItems($basket);
        return md5($basket->getPrice().'='.serialize($lstItems).'@'.serialize($lstCoupons));
    }
    #
    
}
