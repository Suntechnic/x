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
$this->setFrameMode(true);
?>
<div class="container">
    <h2 class="bg-black">Клиенты</h2>
    <div class="clients__grid">
        <?for($i=0; $i<$arParams['TEMPLATE']['SHOW_CNT']; $i++): $dctItem = $arResult['ITEMS'][$i]; if(!$dctItem) break?>
        <?\X\Helpers\Html::render('client',[
                'ITEM' => $dctItem
            ],$component)?>
        
        <?endfor?>
    </div>
    
    <?if(count($arResult['ITEMS']) > $arParams['TEMPLATE']['SHOW_CNT']):?>
        <div class="clients__hidden">
            <div class="clients__grid">
                <?for($i=$arParams['TEMPLATE']['SHOW_CNT']; $i; $i++): $dctItem = $arResult['ITEMS'][$i]; if(!$dctItem) break?>
                    <?\X\Helpers\Html::render('client',[
                            'ITEM' => $dctItem
                        ],$component)?>
                    
                <?endfor?>
            </div>
        </div>
        <div class="clients__button-container">
            <span class="clients__button" onclick="$(this).toggleClass('is-active'); $('.clients__hidden').slideToggle({duration: 1700});">
                <span class="show">Все клиенты</span>
                <span class="hide">Скрыть</span>
            </span>
        </div>
    <?endif?>
    
</div>