<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
//$this->setFrameMode(true);

//Kint::dump($arResult);

if (!$arResult['ITEM']['ID']) return;
$dctItem = $arResult['ITEM'];
?>

<?if ('Y' == $arParams['TEMPLATE']['PREVIEW']): // превью включает блок превью, стили и скрипты?>

    <?=str_replace(['<?=P_IMAGES?>'],[P_IMAGES],$dctItem['PREVIEW_TEXT'])?>
    
    <?foreach($dctItem['PROPERTY_CSS_PATH'] as $css_file):?>
    <link rel="stylesheet" href="<?=$css_file?>">
    <?endforeach?>
    
    <?foreach($dctItem['PROPERTY_JS_PATH'] as $js_file):?>
    <script src="<?=$js_file?>"></script>
    <?endforeach?>
    
    
<?endif?>




<?if ('Y' == $arParams['TEMPLATE']['BODY']):
    //json_encode();
    if($dctItem['PROPERTY_HTML_PATH'] ) {
        echo file_get_contents(S_.$dctItem['PROPERTY_HTML_PATH']);
    }
    ?>
    
    <?=str_replace(['<?=P_IMAGES?>'],[P_IMAGES],$dctItem['DETAIL_TEXT'])?>
    
    
    <?
    // добавляем следующую страницу в бесконечность
    
    $arParams4ajax = [];
    foreach ($arParams as $key=>$val) {
        if ('~' == substr($key,0,1)) continue;
        $arParams4ajax[$key] = $val;
    }
    $signedParams = $component->signVal($arParams4ajax);
    $signedTemplate = $component->signVal($templateName);
    $signedParamsMutation = [
            'FILTERS' => ['PROJECT' => ['CODE'=>$arResult['NEXT_ITEM']['CODE']]],
            'TEMPLATE' => ['PREVIEW' => 'Y']
        ];
    
    $arPreviewParams = [
            'signedParams' => $signedParams,
            'signedTemplate' => $signedTemplate,
            'signedParamsMutation' => $component->signVal($signedParamsMutation)
        ];
    
    $signedParamsMutation['TEMPLATE'] = ['BODY' => 'Y'];
    $arBodyParams = [
            'signedParams' => $signedParams,
            'signedTemplate' => $signedTemplate,
            'signedParamsMutation' => $component->signVal($signedParamsMutation)
        ];
    
    $page = [
            'id' => $arResult['NEXT_ITEM']['ID'],
            'url' => $arResult['NEXT_ITEM']['DETAIL_PAGE_URL'],
            'preview' => [
                    'url' => '/bitrix/services/main/ajax.php?c=x:ib.list&action=execute&mode=class',
                    'data' => $arPreviewParams
                ],
            'body' => [
                    'url' => '/bitrix/services/main/ajax.php?c=x:ib.list&action=execute&mode=class',
                    'data' => $arBodyParams
                ],
        ];
    
    ?>
    
    <script>
        
        if (
                'undefined' != typeof APP
                && 'undefined' != typeof APP.controllers
                && 'undefined' != typeof APP.controllers.infinite
                && 'function' == typeof APP.controllers.infinite.isInited
                && APP.controllers.infinite.isInited()
            ) {
            APP.controllers.infinite.addNextPage(<?=json_encode($page)?>);
        } else {
            document.addEventListener('APPInfiniteInited', function () {APP.controllers.infinite.addNextPage(<?=json_encode($page)?>);});
        }
        
    </script>
<?endif?>