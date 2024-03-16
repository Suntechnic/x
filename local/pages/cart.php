<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('About Us');
$APPLICATION->SetPageProperty('title','About Us');

\Bitrix\Main\UI\Extension::load(['app.vue.components.basket.cart']);
?>
<div class="shopping-cart">
    <div class="container container--type-5">
        <div class="">

            <div class="full-width-our-journal__title-and-action d-flex align-items-center mb-3">
                <h3 class="full-width-our-journal__title">Your cart</h3>
                <!--<div class="full-width-our-journal__action d-md-block d-none">
                    <a href="/">Clear all</a>
                </div>-->
            </div>

            <div vue="BasketCart"></div>

            <?
            $basketOperator = new \App\Basket\Operator;
            $lstBasketItems = $basketOperator->get()['items'];
            if ($lstBasketItems) {
                $lstProduct = array_column($lstBasketItems,'productid');
                $refProduct = \App\Catalog\Helper::refProductInfo($lstProduct);
                $rdb = \CIBlockElement::GetList([], [
                        'IBLOCK_ID' => \Bxx\Helpers\IBlocks::getIdByCode('catalog'),
                        'ID' => array_keys($refProduct),
                        '!PROPERTY_SEO_RELATED' => [false,'',0]
                    ], false, false, [
                        'IBLOCK_ID','ID','PROPERTY_SEO_RELATED'
                    ]);
                $lstRelatedIDs = [];
                while($dctElement = $rdb->GetNext()) {
                    if ($dctElement['PROPERTY_SEO_RELATED_VALUE']) {
                        $lstRelatedIDs = array_merge($lstRelatedIDs,$dctElement['PROPERTY_SEO_RELATED_VALUE']);
                    }
                }
            }

            if ($lstRelatedIDs):
            global $arrFilterRelatedProducts;
            $arrFilterRelatedProducts = ['ID' => $lstRelatedIDs];
            ?>
            <div class="categories mt-5 pt-1 mb-5">
                <div class="">
                    <div class="full-width-our-journal__title-and-action d-flex align-items-center mb-4">
                        <h3 class="full-width-our-journal__title">You may also like</h3>
                        <!-- <div class="full-width-our-journal__action d-md-block d-none">
                            <a href="/">View all</a>
                        </div> -->
                    </div>
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
                            false,
                            ['HIDE_ICONS' => 'Y']
                        );?>
                </div>
            </div>
            <?endif?>
        </div>
    </div>
</div>



<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');?>