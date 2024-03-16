<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');

$context = \Bitrix\Main\Application::getInstance()->getContext();
$request = $context->getRequest();
?> 
<section class="news-page">
    <div class="container container--type-5">
        <?$APPLICATION->IncludeComponent(
                'x:ib.list',
                'news.detail',
                Array(
                        'AJAX_MODE' => 'N',
                        'ELEMENTS_COUNT' => 1,
                        'SORT' => ['DATE_ACTIVE_FROM'=>'DESC', 'ID'=>'DESC'],

                        'FILTER' => [
                                'IBLOCK_ID' => \Bxx\Helpers\IBlocks::getIdByCode('news'),
                                'ACTIVE' => 'Y',
                                'ACTIVE_DATE' => 'Y',
                                'CODE' => $request->get('News')
                            ],
                        'SELECT' => [
                                'NAME',
                                'DETAIL_PICTURE',
                                'DETAIL_TEXT',
                                'DATE_ACTIVE_FROM',
                                'TIMESTAMP_X'
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