<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Catalog');
$APPLICATION->SetPageProperty('title','Catalog');
?> 
<div class="categories mt-5 pt-1">
    <div class="container container--type-5">
        <div class="full-width-our-journal__title-and-action d-flex align-items-center mb-4">
            <h3 class="full-width-our-journal__title">Catalog</h3>
            <!-- <div class="full-width-our-journal__action d-md-block d-none">
                <a href="/">View all</a>
            </div> -->
        </div>
        <?$APPLICATION->IncludeComponent(
                "bitrix:catalog.section.list",
                "",
                Array(
                        "SHOW_PARENT_NAME" => "Y",
                        "IBLOCK_TYPE" => "catalog",
                        "IBLOCK_ID" => \Bxx\Helpers\IBlocks::getIdByCode('catalog'),
                        "COUNT_ELEMENTS" => "Y",
                        "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
                        "HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "N",
                        "TOP_DEPTH" => "1",
                        "CACHE_TYPE" => APPLICATION_ENV=='dev'?'N':'A',
                        "CACHE_TIME" => "36000000",
                        "CACHE_NOTES" => "",
                        "CACHE_GROUPS" => "Y"
                    )		
            );?>
    </div>
</div>

<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');?>