<?php
namespace App\Basket;


class Operator {
    private $user;
    private $basket;
    
    public function __construct() {
        \Bitrix\Main\Loader::includeModule('sale');
        \Bitrix\Sale\DiscountCouponsManager::init();
        
        $this->basket = \Bitrix\Sale\Basket::loadItemsForFUser(
                \Bitrix\Sale\Fuser::getId(),
                \Bitrix\Main\Context::getCurrent()->getSite()
            );
    }
    
    /*
     * возвращает корзину
    */
    public function getBxBasket ()
    {
        return $this->basket;
    }
    #



    /*
     * проверяет есть ли товар с $ProductId в корзине и возвращает его количество
    */
    public function check (int $ProductId): int
    {
        $item = $this->basket->getExistsItem('catalog', $ProductId);
        if ($item) return intval($item->getQuantity());
        return 0;
    }
    #

    /**
     * Получаем данные корзины пользователя
     *
     * @return array
     * @throws Main\ArgumentException
     * @throws Main\ArgumentNullException
     * @throws Main\ArgumentTypeException
     * @throws Main\NotImplementedException
     */
    public function get (): array
    {
        $lstItems = \App\Basket\Helper::getItems($this->basket);
        $lstCoupons = \Bitrix\Sale\DiscountCouponsManager::get(false, [], true, false);
        return [
                'quantity' => count($this->basket->getQuantityList())/*array_sum($basket->getQuantityList())*/,
                'items' => $lstItems,
                'count' => count($lstItems),
                'sum' => $this->basket->getPrice(),
                'coupons' => $lstCoupons,
                'hash' => \App\Basket\Helper::hash($this->basket, $lstItems, $lstCoupons)
            ];
    }

    /**
     * Удаление товара из корзины
     *
     * @param $id
     */
    public function delete (int $id = 0): array
    {
        if ($id > 0) {

            $item = $this->basket->getItemById($id);
            $Quantity = $item->getQuantity();
            if ($item) $item->delete();
            $this->basket->save();
        }
        
        $arResponce = $this->get();
        if (APPLICATION_ENV == 'dev') $arResponce['debug'] = $arDebug;

        return $arResponce;
    }
    
    /*
     * обновляет количество элементов в корзине
    */
    public function update (int $id, int $quantity): array
    {
        if ($id > 0) {
            $item = $this->basket->getItemById($id);
            $CurQuantity = $item->getQuantity();
            $item->setField('QUANTITY', $quantity);
            $this->basket->save();
        }

        $arResponce = $this->get();
        if (APPLICATION_ENV == 'dev') $arResponce['debug'] = $arDebug;
        
        return $arResponce;
    }
    #
    
    /*
     * добавлеят в корзину $quantity элементов товара $ProductId
    */
    public function add (int $ProductId, int $quantity=1, array $lstProps=[]): array
    {
        $arDebug = ['$ProductId' => $ProductId, '$quantity' => $quantity];

        ////////////////////////////////////////////////////////////////////////////
        // добавляем в props свойства добавляемые в корзину
        // для данного ИБ и данного товара
        $lstProps = array_merge($lstProps, \App\Catalog\Helper::getPoductBasketProps($ProductId));
        ////////////////////////////////////////////////////////////////////////////

        if ($ProductId > 0) {
            if ($item = $this->basket->getExistsItem('catalog', $ProductId, $lstProps)) {
                $arDebug['action'] = 'update';
                $item->setField('QUANTITY', $item->getQuantity() + $quantity);
            } else {
                $arDebug['action'] = 'add';
                $item = $this->basket->createItem('catalog', $ProductId);

                $item->setFields([
                        'QUANTITY' => $quantity,
                        'CURRENCY' => \Bitrix\Currency\CurrencyManager::getBaseCurrency(),
                        'LID' => \Bitrix\Main\Context::getCurrent()->getSite(),
                        'PRODUCT_PROVIDER_CLASS' => 'CCatalogProductProvider'
                    ]);
                
                $item->save();

                
                if ($lstProps) {
                    $arDebug['props'] = $lstProps;

                    $propertyCollection = $item->getPropertyCollection();
                    
                    $propertyCollection->setProperty($lstProps);
                    $propertyCollection->save();
                    
                    $item->setPropertyCollection($propertyCollection);
                }

                
            }
            
            $this->basket->save();
        }
        
        

        $arResponce = $this->get();

        if (APPLICATION_ENV == 'dev') $arResponce['debug'] = $arDebug;

        return $arResponce;
    }
    #


    /*
     * применяет купон корзины
    */
    public function applyCoupon (string $coupon): array
    {
        $lstCoupons = \Bitrix\Sale\DiscountCouponsManager::get(false, [], true, false);
        $arDebug = ['$lstCoupons' => $lstCoupons];
        // получим купоны и проверим нет ли этого купона среди примененных
        foreach ($lstCoupons as $ecoupon) {
            if ($ecoupon == $coupon) {
                $coupon = false;
                break;
            }
        }
        
        if ($coupon) {
            $couponChanged = \Bitrix\Sale\DiscountCouponsManager::add($coupon);
            if (!$couponChanged) \Bitrix\Sale\DiscountCouponsManager::delete($coupon);
            $arDebug['$couponChanged'] = $couponChanged;
        }
        
        
        $arResponce = $this->get();
        if (APPLICATION_ENV == 'dev') $arResponce['debug'] = $arDebug;
        return $arResponce;
    }
    #


    /*
     * проверяет есть ли товар с $ProductId в корзине и возвращает его количество
    */
    public function deleteCoupon (string $coupon): array
    {
        $lstCoupons = \Bitrix\Sale\DiscountCouponsManager::get(false, [], true, false);
        $arDebug = ['$lstCoupons' => $lstCoupons];
        // получим купоны и проверим нет ли этого купона среди примененных
        foreach ($lstCoupons as $ecoupon) {
            if ($ecoupon == $coupon) {
                \Bitrix\Sale\DiscountCouponsManager::delete($coupon);
                break;
            }
        }
        
        $arResponce = $this->get();
        if (APPLICATION_ENV == 'dev') $arResponce['debug'] = $arDebug;
        return $arResponce;
    }
    #
    
}