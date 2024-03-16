<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('News');
$APPLICATION->SetPageProperty('title','News');

$context = \Bitrix\Main\Application::getInstance()->getContext();
$request = $context->getRequest();
?> 
<section class="checkout-page">
    <div class="container container--type-5">
        <h1 class="title">News</h1>
        <?$APPLICATION->IncludeComponent(
                'x:ib.list',
                'news',
                Array(
                        'AJAX_MODE' => 'N',
                        'ELEMENTS_COUNT' => 6,
                        'SORT' => ['DATE_ACTIVE_FROM'=>'DESC', 'ID'=>'DESC'],

                        'FILTER' => [
                                'IBLOCK_ID' => \Bxx\Helpers\IBlocks::getIdByCode('news'),
                                'ACTIVE' => 'Y',
                                'ACTIVE_DATE' => 'Y'
                            ],
                        'SELECT' => [
                                'NAME',
                                'PREVIEW_PICTURE',
                                'DETAIL_PAGE_URL',
                                'DATE_ACTIVE_FROM',
                                'TIMESTAMP_X'
                            ],

                        'PAGER' => [
                                'TITLE' => '',
                                'TEMPLATE' => '',
                                'SHOW_ALWAYS' => 'N',
                                'SHOW_ALL' => 'N',
                                'PAGE' => $request->get('PAGEN_1'),
                            ],
                            
                        'CACHE_TYPE' => APPLICATION_ENV=='dev'?'N':'A',
                        'CACHE_TIME' => 3600,
                        'CACHE_FILTER' => 'Y',
                        'CACHE_GROUPS' => 'Y',
                        
                        
                    )
            );?>
    </div>
</section>



<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');?>