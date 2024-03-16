<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Catalog');
$APPLICATION->SetPageProperty('title','Catalog');

$context = \Bitrix\Main\Application::getInstance()->getContext();
$request = $context->getRequest();

$dctSection = \Bitrix\Iblock\SectionTable::getList(array(
        'select' => array('NAME','ID'),
        'filter' => array('CODE' => $request->get('Section'))
    ))->fetch();

if (!$dctSection) {
    \Bitrix\Iblock\Component\Tools::process404(
            'Not news', //Сообщение
            true, // Нужно ли определять 404-ю константу
            true, // Устанавливать ли статус
            true, // Показывать ли 404-ю страницу
            false // Ссылка на отличную от стандартной 404-ю
        );
}

// Фильтр для фильтрации секций
global $arFilterSection;
$FilterName = 'arFilterSection';

$dctSort = \App\Catalog\Component::getSort($request->get('sort'));
?> 

<section class="section-page">
    <div class="container container--type-5">
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <?$APPLICATION->IncludeComponent(
                        "bitrix:catalog.smart.filter",
                        "",
                        array(
                            "IBLOCK_TYPE" => "catalog",
                            "IBLOCK_ID" => \Bxx\Helpers\IBlocks::getIdByCode('catalog'),
                            "SECTION_ID" => $dctSection['ID'],
                            "FILTER_NAME" => $FilterName,
                            "PRICE_CODE" => array("BASE"),
                            "CACHE_TYPE" => APPLICATION_ENV=='dev'?'N':'A',
                            "CACHE_TIME" => 360000,
                            "CACHE_GROUPS" => "Y",
                            "SAVE_IN_SESSION" => "N",
                            "SECTION_TITLE" => "NAME",
                            "SECTION_DESCRIPTION" => "DESCRIPTION",
                            'HIDE_NOT_AVAILABLE' => "N",
                            'CURRENCY_ID' => "USD"
                        )
                    );?>
            </div>
            <div class="col-lg">
                <?
                //$arFilterSection['SECTION_ID'] = $dctSection['ID'];

                ?>
                <h1 class="section-title">
                    <?=$dctSection['NAME']?>
                </h1>
                <?$APPLICATION->IncludeComponent(
                        "bitrix:catalog.section",
                        "list",
                        array_merge(\App\Catalog\Component::getParams(),[
                                "SECTION_ID" => $dctSection['ID'],
                                "SECTION_CODE" => $request->get('Section'),
                                "BROWSER_TITLE" => "-",
                                "CUSTOM_FILTER" => "",
                                //"DETAIL_URL" => "",
                                "ELEMENT_SORT_FIELD" => $dctSort['SORT1'],
                                "ELEMENT_SORT_FIELD2" => $dctSort['SORT2'],
                                "ELEMENT_SORT_ORDER" => $dctSort['ORDER1'],
                                "ELEMENT_SORT_ORDER2" => $dctSort['ORDER2'],
                                "FILTER_NAME" => $FilterName,
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
                                'TEMPLATE' => [
                                    'URI' => \Bitrix\Main\Application::getInstance()
                                            ->getContext()
                                            ->getRequest()
                                            ->getRequestUri()
                                ]
                        ])
                    );?>
            </div>
        </div>
    </div>
</section>



<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');?>