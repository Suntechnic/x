<div class="categories mt-5 pt-1">
    <div class="container container--type-5">
        <div class="full-width-our-journal__title-and-action d-flex align-items-center mb-4">
            <h3 class="full-width-our-journal__title">New Sellers</h3>
            <!-- <div class="full-width-our-journal__action d-md-block d-none">
                <a href="/">View all</a>
            </div> -->
        </div>
        <?
        global $arBestSellerFilter; $arBestSellerFilter = ['PROPERTY_SEO_MARK_VALUE' => 'NEW'];
        $APPLICATION->IncludeComponent(
                "bitrix:catalog.section",
                "list-simple",
                array_merge(\App\Catalog\Component::getParams(),[
                        "BROWSER_TITLE" => "-",
                        "CONVERT_CURRENCY" => "Y",
                        "CUSTOM_FILTER" => "",
                        "DETAIL_URL" => "#SITE_DIR#/catalog/#SECTION_CODE#/#CODE#/",
                        "ELEMENT_SORT_FIELD" => $dctSort['SORT1'],
                        "ELEMENT_SORT_FIELD2" => $dctSort['SORT2'],
                        "ELEMENT_SORT_ORDER" => $dctSort['ORDER1'],
                        "ELEMENT_SORT_ORDER2" => $dctSort['ORDER2'],
                        "FILTER_NAME" => 'arBestSellerFilter',
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
                        'SHOW_ALL_WO_SECTION' => 'Y',
                        'BY_LINK' => 'Y'
                ])
            );?>
    </div>
</div>