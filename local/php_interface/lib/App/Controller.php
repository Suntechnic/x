<?php
namespace App;

class Controller extends \Bitrix\Main\Engine\Controller
{       
    private $actionsConfig = [
            'config' => [
                   '-prefilters' => [
                           '\Bitrix\Main\Engine\ActionFilter\Authentication'
                       ],
               ],
            'refProductInfo' => [
                   '-prefilters' => [
                           '\Bitrix\Main\Engine\ActionFilter\Authentication'
                       ],
               ],
            'basket' => [
                   '-prefilters' => [
                           '\Bitrix\Main\Engine\ActionFilter\Authentication'
                       ],
               ],
            'basketAdd' => [
                   '-prefilters' => [
                           '\Bitrix\Main\Engine\ActionFilter\Authentication'
                       ],
               ],
            'basketUpdate' => [
                   '-prefilters' => [
                           '\Bitrix\Main\Engine\ActionFilter\Authentication'
                       ],
               ],
            'basketDelete' => [
                   '-prefilters' => [
                           '\Bitrix\Main\Engine\ActionFilter\Authentication'
                       ],
               ],
            'applyCoupon' => [
                   '-prefilters' => [
                           '\Bitrix\Main\Engine\ActionFilter\Authentication'
                       ]
               ],
            'deleteCoupon' => [
                   '-prefilters' => [
                           '\Bitrix\Main\Engine\ActionFilter\Authentication'
                       ]
               ],
            'favorites' => [
                   '-prefilters' => [
                           '\Bitrix\Main\Engine\ActionFilter\Authentication'
                       ],
               ],
            'favoritesDelete' => [
                   '-prefilters' => [
                           '\Bitrix\Main\Engine\ActionFilter\Authentication'
                       ],
               ],
            'favoritesAdd' => [
                   '-prefilters' => [
                           '\Bitrix\Main\Engine\ActionFilter\Authentication'
                       ],
               ],
            'sendFeedback' => [
                   '-prefilters' => [
                           '\Bitrix\Main\Engine\ActionFilter\Authentication'
                       ],
                ],
            'getUserProfile' => [],
            'setUserProfile' => [],
        ];

    protected function init()
    {
        parent::init();
        foreach ($this->actionsConfig as $name=>$arConfig) $this->setActionConfig($name, $arConfig);
    }
    
    public function configAction ()
    {
        return \App\Settings::getConfig();
    }

    public function basketAddAction (array $lstItems)
    {
        $basketOperator = new \App\Basket\Operator;
        $arResponces = [];
        foreach ($lstItems as $dctItem) {
            if ($dctItem['id'] && $dctItem['quantity']) {
                $arProps = $dctItem['props']?$dctItem['props']:[];
                $arResponces[] = $basketOperator->add($dctItem['id'],$dctItem['quantity'],$arProps);
            }
        }
        $arResponce = $basketOperator->get();
        $arResponce['responces'] = $arResponces;
        return $arResponce;
    }


    /*
     * обновляет количество элементов в корзине
    */
    public function basketUpdateAction (int $id, int $quantity): array
    {
        $basketOperator = new \App\Basket\Operator;
        return $basketOperator->update($id,$quantity);
    }
    #

    /*
     * обновляет количество элементов в корзине
    */
    public function basketDeleteAction (int $id): array
    {
        $basketOperator = new \App\Basket\Operator;
        return $basketOperator->delete($id);
    }
    #


    public function basketAction ()
    {
        $basketOperator = new \App\Basket\Operator;
        return $basketOperator->get();
    }

    /*
     * применяет купон корзины
    */
    public function applyCouponAction(string $coupon): array
    {
        $basketOperator = new \App\Basket\Operator;
        return $basketOperator->applyCoupon($coupon);
    }
    #


    /*
     * проверяет есть ли товар с $productid в корзине и возвращает его количество
    */
    public function deleteCouponAction(string $coupon): array
    {
        $basketOperator = new \App\Basket\Operator;
        return $basketOperator->deleteCoupon($coupon);
    }
    #

    /**
     * Возвращает справочник информации о товарах
     * по id товара или SKU
     */
    public function refProductInfoAction ($id): array
    {
        if (!is_array($id)) $id = [$id];
        return \App\Catalog\Helper::refProductInfo($id);
    }
    #

    public function favoritesAction ()
    {
        \Bitrix\Main\Loader::includeModule('serginhold.favorites');
        $storage = \SerginhoLD\Favorites\Factory::getStorageForCurrentUser();
        return $storage->getList();
    }

    public function favoritesAddAction (int $Id)
    {
        \Bitrix\Main\Loader::includeModule('serginhold.favorites');
        $storage = \SerginhoLD\Favorites\Factory::getStorageForCurrentUser();
        $storage->add($Id);
        return $storage->getList();
    }

    public function favoritesDeleteAction (int $Id)
    {
        \Bitrix\Main\Loader::includeModule('serginhold.favorites');
        $storage = \SerginhoLD\Favorites\Factory::getStorageForCurrentUser();
        $storage->delete($Id);
        return $storage->getList();
    }


    #TODO: проверить на безопасность
    public function getUserProfileAction ($Id): array
    {
        global $USER;
        if ($USER->isAuthorized() && $Id == intval($USER->getId())) {
            $dct = \CUser::GetList(
                    $by,$desc,
                    ['ID'=>$Id],
                    ['FIELDS' => ['NAME','LAST_NAME','EMAIL','ID']]
                )->fetch();
            $dctFields = [];
            if ($Id == $dct['ID']) {
                return ['userid' => $Id,'values'=>$dct];
            } else {
                throw new \Bitrix\Main\SystemException('Error', 1000);
            }
        } else throw new \Bitrix\Main\SystemException('Access error', 1000);
        
    }
    
    public function setUserProfileAction ($Id, $Values=[], $Pass=[]): array
    {
        global $USER;
        if ($USER->isAuthorized() && $Id == intval($USER->getId())) {

            $dctBxFields = $Values;
            if ($Pass['pass'] && $Pass['pass'] == $Pass['confirm']) {
                $dctBxFields["PASSWORD"] = $Pass['pass'];
                $dctBxFields["CONFIRM_PASSWORD"] = $Pass['confirm'];
            }

            if ($dctBxFields) {
                $user = new \CUser;
                $user->Update($Id, $dctBxFields);
            }

        } else throw new \Bitrix\Main\SystemException('Access error', 1000);

        
        return $this->getUserProfileAction($Id);
    }

    

    // public function sendFeedbackAction (array $form)
    // {
    //     $arResult = ['debug'=>[]];


    //     $Contact = ($form['name']?('*'.$form['name'].'* '):'').'`'.$form['phone'].'`';
    //     $Text = '';

    //     if ($form['type'] == 'not') {
    //         $arResult['message'] = [
    //                 'title' => 'Мы получили Ваше сообщение!', 
    //                 'text' => 'Обязательно свяжемся с Вами если места освободятся.'
    //             ];
    //         $Text = 'Запрос на овербукинг. Даты с *'
    //                 .$form['dfrom'].'* по *'.$form['dto']
    //                 .'*. Количество гостей: '.$form['guests'];
    //     } else if ($form['type'] == 'mosaic') {
    //         $Text = 'Запрос на шахамотную бронь с *'
    //                 .$form['dfrom'].'* по *'.$form['dto']
    //                 .'*. Количество гостей: '.$form['guests'];
    //         $arResult['message'] = [
    //                 'title' => 'Мы получили Ваше сообщение!', 
    //                 'text' => 'В ближашее время перезвоним Вам и предложим варианты размещения.'
    //             ];
    //     }

    //     \Bitrix\Main\Loader::includeModule('iblock');
    //     $rsElement = new \CIBlockElement;
    //     $dctFields = array(
    //             'IBLOCK_ID'         => \Bxx\Helpers\IBlocks::getIdByCode('feedbacks'),
    //             'NAME'              => $Contact,
    //             'PREVIEW_TEXT'      => $Text
    //         );
    //     $rsElement->Add($dctFields);
    //     $arResult['debug']['addelmerror'] = $rsElement->LAST_ERROR;

        

    //     $tg = new \App\Telegram;
    //     $tg->send($Text."\n".$Contact."\nОтправлено со страницы ".$form['url']);


    //     if (APPLICATION_ENV != 'dev') unset($arResult['debug']);
    //     return $arResult;
    // }
}