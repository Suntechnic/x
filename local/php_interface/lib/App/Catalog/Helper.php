<?php
declare(strict_types=1);

namespace App\Catalog;

/*
 * здесь и далее используются следующие обозначения
 * Offer - элемент $arResult формируемый штатными каталожными компонентами, в OFFERS и так далее
 * SKU - объект данных инфоблока торговых предложений
 * Product - объект данных инфоблоков каталога или тп, когда между ними нет разницы
 * 
*/

class Helper {

    private static $_memoizing = [];


    /**
     * Возвращает список свойств со значенияеми которые нужно добавить в корзину для данного товара
     */
    public static function getPoductBasketProps (int $Id): array
    {
        \Bitrix\Main\Loader::includeModule('iblock');
        \Bitrix\Main\Loader::includeModule('catalog');

        $IBLOCK_ID = \Bitrix\Iblock\ElementTable::getList([
                'select' => ['IBLOCK_ID'],
                'filter' => ['ID' => $Id]
            ])->fetch()['IBLOCK_ID'];

        // получим список свойств которые нужно добавлять в корзину вместе с товаром.
        $lstProps = self::getBasketProperties(intval($IBLOCK_ID));

        // получим значения этих свойств для элемента
        $lstPropsCode = array_map(function($Code){return 'PROPERTY_'.$Code;},array_column($lstProps,'CODE'));
        $dctPropsElement = \CIBlockElement::GetList([],
                ['ID' => $Id],
                false, false,
                $lstPropsCode
            )->fetch();
        
        // реализуем список добавляемых свойств
        $lst = [];
        foreach ($lstProps as $dctProp) {
            $Value = $dctPropsElement['PROPERTY_'.$dctProp['CODE'].'_VALUE'];
            if ($Value) {
                if ($dctProp['USER_TYPE'] == 'directory') { // если это справочинки - преобразуем значение
                    $reference = \App\Reference::getInstanceByTable($dctProp['USER_TYPE_SETTINGS']['TABLE_NAME']);
                    $arValue = $reference->get($Value);
                    if (is_set($arValue['UF_NAME'])) $Value = $arValue['UF_NAME'];
                }
                $lst[] = [
                        'NAME' => $dctProp['NAME'],
                        'CODE' => 'IB'.$IBLOCK_ID.'_'.$dctProp['CODE'],
                        'VALUE' => $Value,
                        'SORT' => 100
                    ];
            }
        }

        return $lst;
    }


    /**
     * Возвращает список свойств которые нужно добавить в корзину для данного инфоблока
     */
    public static function getBasketProperties (int $IBlockId): array
    {
        $lstProps = [];
        if (!isset(self::$_memoizing['getBasketProperties'][$IBlockId])) {
            $lstPropsIds = \Bitrix\Catalog\Product\PropertyCatalogFeature::getBasketPropertyCodes($IBlockId);
            if ($lstPropsIds) {
                $rdbProperties = \CIBlockProperty::GetList(
                        ['SORT' => 'ASC'],
                        [
                                'ACTIVE'    => 'Y',
                                'IBLOCK_ID' => $IBlockId
                            ]
                    );
                
                while($dctProp = $rdbProperties->fetch()) {
                    if (in_array($dctProp['ID'],$lstPropsIds)) {
                        $lstProps[] = $dctProp;
                    }
                }
            }

            self::$_memoizing['getBasketProperties'][$IBlockId] = $lstProps;
        }

        return self::$_memoizing['getBasketProperties'][$IBlockId];
    }




    /**
     * Возвращает справочник информации о товарах
     * включающий остатки, доступность в каталоге, название, дополнительные фото и детальную ссылку
     * по id товара или SKU
     *
     * Если итоговый справочник будет содержать в качестве ключей все id переданные в списке
     * а так же id товаров, если в списке переданы id Sku
     * к примеру если в списке есть id Sku 9067, то итоговом списке будет два ключа: 9067 и 3140
     * - id товара к которому относится данный SKU
     *
     * массив будет содержать кроме прочих следующие ключи:
            NAME => string (5) "Amani"
            DETAIL_PAGE_URL => string (31) "/divany/pryamye-divany/amani_1/"
            CODE => string (7) "amani_1"
            EXTERNAL_ID => string (36) "f4c3d781-2b12-11eb-a88a-00505685f389"
            IBLOCK_SECTION_ID => string (3) "333"
            CATALOG_QUANTITY => string (1) "0"
            CATALOG_AVAILABLE => string (1) "Y"
     */
    public static function refProductInfo (array $lstIDs): array
    {
        \Bitrix\Main\Loader::includeModule('iblock');
        $ref = [];
        if (count($lstIDs)) {
            // массив каталожной информации
            $lstCatalogProp = array_merge(
                    ['CATALOG_QUANTITY','CATALOG_AVAILABLE'],
                    [], // array_map(function($id){return 'CATALOG_PRICE_'.$id;},\App\Catalog\Prices::lstId())
                );
            $refCatalogProp = array_combine($lstCatalogProp,$lstCatalogProp);
            
            $db_res = \CIBlockElement::GetList([],
                    [
                            'IBLOCK_ID' => \Bxx\Helpers\IBlocks::getIdByCode('offers'),
                            'ID' => $lstIDs
                        ],
                    false, false,
                    array_merge(['ID','PROPERTY_CML2_LINK','NAME','PREVIEW_PICTURE','DETAIL_PICTURE'],$lstCatalogProp)
                );
            while($dctSku = $db_res->fetch()) {
                $dctSku['DETAIL_PAGE_URL'] = ''; //Url::getDetailPageUrl(intval($dctSku['ID']));
                $ref[$dctSku['ID']] = $dctSku;
            }
            
            // информация о товарах
            $db_res = \CIBlockElement::GetList([],
                    [   
                            'IBLOCK_ID' => \Bxx\Helpers\IBlocks::getIdByCode('catalog'),
                            'ID' => array_merge($lstIDs,array_column($ref,'PROPERTY_CML2_LINK_VALUE'))
                        ],
                    false, false,
                    array_merge(['ID','NAME','DETAIL_PAGE_URL','PREVIEW_PICTURE','DETAIL_PICTURE'],$lstCatalogProp)
                );
            while($dctProduct = $db_res->getNext()) {
                $ref[$dctProduct['ID']] = $dctProduct;
            }
            
            
            foreach ($ref as $Id=>$dct) {
                
                // очищаем от ~ свойств
                $dct = array_filter($dct,function ($k) {return ('~' != substr($k,0,1));},ARRAY_FILTER_USE_KEY);
                
                
                // очищаем от лишних каталожных свойств
                $dct = array_filter($dct,function ($k) use ($refCatalogProp) {return ('CATALOG_' != substr($k,0,8) || $refCatalogProp[$k]);},ARRAY_FILTER_USE_KEY);
                

                // наследуем DETAIL_PAGE_URL от товара, если его нет у торгового предложения
                if (!$dct['DETAIL_PAGE_URL']
                        && $ref[$dct['PROPERTY_CML2_LINK_VALUE']]['DETAIL_PAGE_URL']
                    ) {
                    $dct['DETAIL_PAGE_URL'] = $ref[$dct['PROPERTY_CML2_LINK_VALUE']]['DETAIL_PAGE_URL'];
                }


                // добавлеям превью картинку
                $PhotoId = self::getPhotoId($dct);
                // наследуем картинку от товара, если его нет у торгового предложения
                if (!$PhotoId // картинки не нашлось,
                        && $ref[$dct['PROPERTY_CML2_LINK_VALUE']] // но это предложение для которого есть товар
                    ) {
                    $PhotoId = self::getPhotoId($ref[$dct['PROPERTY_CML2_LINK_VALUE']]);
                }


                if ($PhotoId) {
                    $dct['PICTURE'] = \CFile::GetFileArray($PhotoId);
                } else {
                    $dct['PICTURE'] = $PhotoId;
                }

                // обновляем
                $ref[$dct['ID']] = $dct;
            }
        }
        return $ref;
    }


    /*
     * ищет в массиве товара id изображения
    */
    public static function getPhotoId (array $dct): int
    {
        $PhotoId = 0;
        if ($dct['DETAIL_PICTURE']) {
            $PhotoId = $dct['DETAIL_PICTURE'];
        } elseif ($dct['PREVIEW_PICTURE']) {
            $PhotoId = $dct['PREVIEW_PICTURE'];
        } elseif ($dct['PROPERTY_GALLERY_VALUE']) {
            $PhotoId = $dct['PROPERTY_GALLERY_VALUE'];
            if (is_array($PhotoId)) $PhotoId = $PhotoId[0];
        }

        return intval($PhotoId);
    }
    #


     /*
     * валидирует торговое предложение каталога
    */
    public static function validateOffer (array $arFields)
    {
        
        if ($arFields['IBLOCK_ID'] == 2 && $arFields['ID']) {
            $lstSelect = [
                    'IBLOCK_ID',
                    'ID',
                    'NAME',
                    'PREVIEW_TEXT',
                    'PREVIEW_PICTURE',
                    'DETAIL_TEXT',
                    'DETAIL_PICTURE'
                ];
            $dctFilter = [
                    'IBLOCK_ID'=> $IBLOCK_ID,
                    'SECTION_ID' => $SECTION_ID,
                    'ACTIVE_DATE' => 'Y',
                    'ACTIVE'=>'Y'
                 ];

            $rdb = \CIBlockElement::GetList(
                    [],
                    ['IBLOCK_ID' =>$arFields['IBLOCK_ID'], 'ID'=>$arFields['ID']], 
                    false, false, 
                    ['ID','IBLOCK_ID','PROPERTY_DEEPFROM','PROPERTY_DEEPTO']
                );

            if ($dctElement = $rdb->fetch()) {
                if ($dctElement['PROPERTY_DEEPFROM_VALUE']
                        && $dctElement['PROPERTY_DEEPTO_VALUE']
                        && $dctElement['PROPERTY_DEEPFROM_VALUE'] > $dctElement['PROPERTY_DEEPTO_VALUE']
                    ) {
                    $DEEPTO = $dctElement['PROPERTY_DEEPFROM_VALUE'];
                    $DEEPFROM = $dctElement['PROPERTY_DEEPTO_VALUE'];
                    \CIBlockElement::SetPropertyValuesEx(
                            $dctElement['ID'],
                            $dctElement['IBLOCK_ID'],
                            ['DEEPFROM' => $DEEPFROM, 'DEEPTO' => $DEEPTO]
                        );
                }
            }
        }
    }
    #




}