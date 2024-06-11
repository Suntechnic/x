<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Catalog\ProductTable;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

?>
<section class="section-page">
    <div class="container container--type-5">
        <div class="cart-wrapper">

            <div class="d-block d-lg-none mb-4">
                <?$APPLICATION->IncludeComponent("bitrix:breadcrumb","",
                        Array(
                                "START_FROM" => "1", 
                                "PATH" => "", 
                                "SITE_ID" => "s1" 
                            ),
                        $component,
                        ['HIDE_ICONS' => 'Y']
                    );?>
            </div>

            <div class="row mb-4">
                <div class="col-lg-6">
                    <?include('template.photos.php');?>
                </div>
                <div class="col-lg-6">
                    <div class="d-none d-lg-block">
                        <?$APPLICATION->IncludeComponent("bitrix:breadcrumb","",Array(
                                    "START_FROM" => "1", 
                                    "PATH" => "", 
                                    "SITE_ID" => "s1" 
                                ),
                                $component,
                                ['HIDE_ICONS' => 'Y']
                            );?>
                    </div>
                    <div class="product-title">
                        <?=$arResult['NAME']?>
                    </div>

                    <?if($arResult['DISPLAY_PROPERTIES']['RATING']):?>
                    <?$APPLICATION->IncludeComponent(
                            'x:x',
                            'rating',
                            Array(
                                    'TEMPLATE' => [
                                            'RATING_VALUE' => $arResult['DISPLAY_PROPERTIES']['RATING']['VALUE']
                                        ]
                                ),
                            $component,
                            ['HIDE_ICONS' => 'Y']
                        );?>
                    <?endif?>


                    <?
                    $arResult['VUE_OFFERS'] = [];

                    $lstVueOfferKeys = [
                            'ID',
                            'NAME',
                            //'ITEM_PRICES',
                            'PREVIEW_PICTURE',
                            'MAX_QUANTITY',
                            'STEP_QUANTITY',
                            'CAN_BUY'
                        ];
                    $mapOffersId2I = array_combine(
                            array_column($arResult['OFFERS'],'ID'),
                            array_keys($arResult['OFFERS'])
                        );
                    
                    foreach ($arResult['JS_OFFERS'] as $dctJsOffer) {
                        $dctVueOffer = [];
                        foreach ($lstVueOfferKeys as $Key) $dctVueOffer[$Key] = $dctJsOffer[$Key];

                        $refProperties = $arResult['OFFERS'][$mapOffersId2I[$dctJsOffer['ID']]]['PROPERTIES'];

                        $dctVueOffer['PROPERTIES_VALUE'] = array_combine(
                                array_keys($refProperties),
                                array_column($refProperties,'VALUE')
                            );
                        foreach ($refProperties as $Code=>$arProp) {
                            if ($arProp['VALUE_ENUM_ID']) 
                                    $dctVueOffer['PROPERTIES_VALUE_ENUM_ID'][$Code] = $arProp['VALUE_ENUM_ID'];
                        }


                        $dctVueOffer['PRICE'] = $dctJsOffer['ITEM_PRICES'][$dctJsOffer['ITEM_PRICE_SELECTED']];

                        $arResult['VUE_OFFERS'][] = $dctVueOffer;
                    }
                    ?>

                    <div vue="CatalogElement">
                        <script type="extension/settings" name="propses"><?=json_encode($arResult['SKU_PROPS'])?></script>
                        <script type="extension/settings" name="offers"><?=json_encode($arResult['VUE_OFFERS'])?></script>
                    </div>


                    <div class="row align-items-center ">
                        <div class="col mb-4">
                            <div class="product-btns">
                                <span 
                                        vue="FavoriteButton" 
                                        data-elementid="<?=$arResult['ID']?>"
                                        data-template="circle"
                                    ></span>
                            </div>
                        </div>

                        <div class="col-auto mb-4">
                            <?include('template.share.php');?>
                        </div>
                    </div>
                    <?include('template.charsdocs.php');?>
                </div>
            </div>
            <div class="d-none d-md-block">
                <div class="tabs-list">
                    <?if($arResult['DETAIL_TEXT']):?>
                    <div class="tabs-item tabs-item--active js-open-tab" data-id="tabs-1">Description</div>
                    <?endif?>
                    <?/*?>
                    <div class="tabs-item js-open-tab" data-id="tabs-2">Review
                        <span>(12)</span>
                    </div>
                    <?/**/?>
                    <?if($arResult['NEWS']):?>
                    <div class="tabs-item js-open-tab" data-id="tabs-3">News</div>
                    <?endif?>
                </div>
                <div class="tabs-content">
                    <?if($arResult['DETAIL_TEXT']):?>
                    <div class="tab-body js-tab active" data-id="tabs-1">
                        <?=$arResult['DETAIL_TEXT']?>
                    </div>
                    <?endif?>
                    <?/*?>
                    <div class="tab-body js-tab" data-id="tabs-2">
                        <div class="review-main">
                            <div class="review-stats">
                                <div class="rating-product">
                                    <div class="star star--active"></div>
                                    <div class="star star--active"></div>
                                    <div class="star star--active"></div>
                                    <div class="star star--active"></div>
                                    <div class="star star"></div>
                                    <div class="rating-product__count"><strong>4.5</strong> <span>12
                                            reviews</span></div>
                                </div>
                                <a href="#" class="add-cart second-button">Write a Review</a>
                            </div>
                            <div class="review-list">
                                <div class="review-item">

                                    <div class="review-item__header">
                                        <div class="review-item__name">Alex Sanchez</div>

                                        <div class="review-item__date">2 monts ago</div>

                                    </div>
                                    <div class="review-item-stars">
                                        <div class="review-star"></div>
                                        <div class="review-star"></div>
                                        <div class="review-star"></div>
                                        <div class="review-star review-star--only"></div>
                                        <div class="review-star review-star--clear"></div>
                                    </div>
                                    <div class="review-item__title">Striking Contemporary Chandelier</div>
                                    <div class="review-item__desc">
                                        We got this for our living room (vaulted ceiling - large room) in the
                                        Polished Aluminum finish. It's beautiful! I love everything about it. Be
                                        warned that it comes in a HUGE box!
                                    </div>
                                    <div class="review-item__footer">
                                        <div class="row">
                                            <div class="col"><a href="#" class="review-item__read-more">Read
                                                    More</a></div>
                                            <div class="col-auto">
                                                <div class="review-item_links">
                                                    <a href="#">Helpful</a>
                                                    <a href="#">Report</a>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="review-item">

                                    <div class="review-item__header">
                                        <div class="review-item__name">Alex Sanchez</div>

                                        <div class="review-item__date">2 monts ago</div>

                                    </div>
                                    <div class="review-item-stars">
                                        <div class="review-star"></div>
                                        <div class="review-star"></div>
                                        <div class="review-star"></div>
                                        <div class="review-star review-star--only"></div>
                                        <div class="review-star review-star--clear"></div>
                                    </div>
                                    <div class="review-item__title">Striking Contemporary Chandelier</div>
                                    <div class="review-item__desc">
                                        We got this for our living room (vaulted ceiling - large room) in the
                                        Polished Aluminum finish. It's beautiful! I love everything about it. Be
                                        warned that it comes in a HUGE box!
                                    </div>
                                    <div class="review-item__footer">
                                        <div class="row">
                                            <div class="col"><a href="#" class="review-item__read-more">Read
                                                    More</a></div>
                                            <div class="col-auto">
                                                <div class="review-item_links">
                                                    <a href="#">Helpful</a>
                                                    <a href="#">Report</a>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="review-item">

                                    <div class="review-item__header">
                                        <div class="review-item__name">Alex Sanchez</div>

                                        <div class="review-item__date">2 monts ago</div>

                                    </div>
                                    <div class="review-item-stars">
                                        <div class="review-star"></div>
                                        <div class="review-star"></div>
                                        <div class="review-star"></div>
                                        <div class="review-star review-star--only"></div>
                                        <div class="review-star review-star--clear"></div>
                                    </div>
                                    <div class="review-item__title">Striking Contemporary Chandelier</div>
                                    <div class="review-item__desc">
                                        We got this for our living room (vaulted ceiling - large room) in the
                                        Polished Aluminum finish. It's beautiful! I love everything about it. Be
                                        warned that it comes in a HUGE box!
                                    </div>
                                    <div class="review-item__footer">
                                        <div class="row">
                                            <div class="col"><a href="#" class="review-item__read-more">Read
                                                    More</a></div>
                                            <div class="col-auto">
                                                <div class="review-item_links">
                                                    <a href="#">Helpful</a>
                                                    <a href="#">Report</a>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <?/**/?>
                    <?if($arResult['NEWS']):?>
                    <div class="tab-body js-tab" data-id="tabs-3">
                        <?$APPLICATION->IncludeComponent(
                                'x:ib.list',
                                'news',
                                Array(
                                        'AJAX_MODE' => 'N',
                                        'ELEMENTS_COUNT' => 3,
                                        'SORT' => ['DATE_ACTIVE_FROM'=>'DESC', 'ID'=>'DESC'],

                                        'FILTER' => [
                                                'IBLOCK_ID' => \Bxx\Helpers\IBlocks::getIdByCode('news'),
                                                'ACTIVE' => 'Y',
                                                'ACTIVE_DATE' => 'Y',
                                                'ID' => $arResult['NEWS']
                                            ],
                                        'SELECT' => [
                                                'NAME',
                                                'PREVIEW_PICTURE',
                                                'DETAIL_PAGE_URL',
                                                'DATE_ACTIVE_FROM',
                                                'TIMESTAMP_X'
                                            ],
                                            
                                        'CACHE_TYPE' => APPLICATION_ENV=='dev'?'N':'A',
                                        'CACHE_TIME' => 3600,
                                        'CACHE_FILTER' => 'Y',
                                        'CACHE_GROUPS' => 'Y',
                                        
                                        
                                    ),
                                $component,
                                ['HIDE_ICONS' => 'Y']
                            );?>
                    </div>
                    <?endif?>
                </div>
            </div>
        </div>
        <?if($arResult['PROPERTIES']['SEO_RELATED']['VALUE']):
        global $arrFilterRelatedProducts;
        $arrFilterRelatedProducts = ['ID' => $arResult['PROPERTIES']['SEO_RELATED']['VALUE']];
        ?>
        <div class="categories">
            <h3 class="full-width-our-journal__title mb-4">Related Products</h3>
            <?$APPLICATION->IncludeComponent(
                    "bitrix:catalog.section",
                    "slider",
                    array_merge(\App\Catalog\Component::getParams(),[
                            "BROWSER_TITLE" => "-",
                            "CONVERT_CURRENCY" => "Y",
                            "CUSTOM_FILTER" => "",
                            //"DETAIL_URL" => "",
                            "ELEMENT_SORT_FIELD" => $dctSort['SORT1'],
                            "ELEMENT_SORT_FIELD2" => $dctSort['SORT2'],
                            "ELEMENT_SORT_ORDER" => $dctSort['ORDER1'],
                            "ELEMENT_SORT_ORDER2" => $dctSort['ORDER2'],
                            "FILTER_NAME" => "arrFilterRelatedProducts",
                            "HIDE_NOT_AVAILABLE" => "N",
                            "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                            "INCLUDE_SUBSECTIONS" => "Y",
                            "META_DESCRIPTION" => "-",
                            "META_KEYWORDS" => "-",
                            "OFFERS_SORT_FIELD" => "sort",
                            "OFFERS_SORT_FIELD2" => "id",
                            "OFFERS_SORT_ORDER" => "asc",
                            "OFFERS_SORT_ORDER2" => "desc",
                            "PAGE_ELEMENT_COUNT" => 1800,
                            "SET_BROWSER_TITLE" => "Y",
                            "SET_LAST_MODIFIED" => "N",
                            "SET_META_DESCRIPTION" => "Y",
                            "SET_META_KEYWORDS" => "Y",
                            "SET_STATUS_404" => "Y",
                            "SET_TITLE" => "Y",
                            'SHOW_ALL_WO_SECTION' => 'Y',
                            'BY_LINK' => 'Y'
                        ]),
                    $component,
                    ['HIDE_ICONS' => 'Y']
                );?>
        </div>
        <?endif?>
    </div>
</section>