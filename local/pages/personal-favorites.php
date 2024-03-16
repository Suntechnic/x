<?
define('NEED_AUTH',true);
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Personal');
$APPLICATION->SetPageProperty('title','Personal contact');
?> 
<section class="lk">
    <div class="container container--type-5">
        <div class="row">
            <div class="col-lg-3 order-lg-1 order-2">
                <?include(DEFAULT_TEMPLATE_PATH.'/includes/personal-menu.php');?>
            </div>

            <div class="col-lg order-lg-2 order-1 lk-content mb-5 mb-lg-0">
                <?
                global $arFavoritesFilter;
                $controller = new \App\Controller;
                $arFavoritesFilter = ['ID' => $controller->favoritesAction()];

                if ($arFavoritesFilter['ID']) {
                    $APPLICATION->IncludeComponent(
                            "bitrix:catalog.section",
                            "list-simple",
                            array_merge(\App\Catalog\Component::getParams(),[
                                    "BROWSER_TITLE" => "-",
                                    "CONVERT_CURRENCY" => "Y",
                                    "CUSTOM_FILTER" => "",
                                    //"DETAIL_URL" => "",
                                    "ELEMENT_SORT_FIELD" => $dctSort['SORT1'],
                                    "ELEMENT_SORT_FIELD2" => $dctSort['SORT2'],
                                    "ELEMENT_SORT_ORDER" => $dctSort['ORDER1'],
                                    "ELEMENT_SORT_ORDER2" => $dctSort['ORDER2'],
                                    "FILTER_NAME" => 'arFavoritesFilter',
                                    "HIDE_NOT_AVAILABLE" => "N",
                                    "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                                    "INCLUDE_SUBSECTIONS" => "Y",
                                    "META_DESCRIPTION" => "-",
                                    "META_KEYWORDS" => "-",
                                    "OFFERS_SORT_FIELD" => "sort",
                                    "OFFERS_SORT_FIELD2" => "id",
                                    "OFFERS_SORT_ORDER" => "asc",
                                    "OFFERS_SORT_ORDER2" => "desc",
                                    "PAGE_ELEMENT_COUNT" => 8,
                                    "SET_BROWSER_TITLE" => "N",
                                    "SET_LAST_MODIFIED" => "N",
                                    "SET_META_DESCRIPTION" => "N",
                                    "SET_META_KEYWORDS" => "N",
                                    "SET_STATUS_404" => "N",
                                    "SET_TITLE" => "N",
                            ])
                        );
                } else {
                     ?><p>В избранном пока ничего нет</p><?
                }
                ?>
            </div>
        </div>
    </div>
</section>
<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');?>