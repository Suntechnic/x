<?
if (!$arResult['ITEM']) return;
$dctItem = $arResult['ITEM'];
?>

<div class="news-page__main">
    <?$APPLICATION->IncludeComponent("bitrix:breadcrumb","",Array(
                "START_FROM" => "1", 
                "PATH" => "", 
                "SITE_ID" => "s1" 
            )
        );?>

    <div class="row">
        <div class="col-lg order-lg-1 mb-3 mb-lg-0">
            <div class="title"><?=$dctItem['NAME']?></div>
            <?if($dctItem['DETAIL_PICTURE']):?>
            <div class="d-block d-lg-none mb-4">
                <img src="<?=$dctItem['DETAIL_PICTURE']['SRC']?>" class="img-right-news" alt="">
            </div>
            <?endif?>
            <?=$dctItem['DETAIL_TEXT']?>
        </div>

        <div class="col-lg order-lg-2 d-none d-lg-block pt-3">
            <?include('template.sharing.php');?>
            <?if($dctItem['DETAIL_PICTURE']):?>
            <img src="<?=$dctItem['DETAIL_PICTURE']['SRC']?>" class="img-right-news" alt="">
            <?endif?>
        </div>
    </div>
</div>
<?$APPLICATION->IncludeComponent(
        'x:ib.list',
        'news.other',
        Array(
                'AJAX_MODE' => 'N',
                'ELEMENTS_COUNT' => 6,
                'SORT' => ['DATE_ACTIVE_FROM'=>'DESC', 'ID'=>'DESC'],

                'FILTER' => [
                        'IBLOCK_ID' => \Bxx\Helpers\IBlocks::getIdByCode('news'),
                        'ACTIVE' => 'Y',
                        'ACTIVE_DATE' => 'Y',
                        '!ID' => $dctItem['ID']
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
                
                
            )
    );?>