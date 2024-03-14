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
<?if(count($arResult['ITEMS'])):?>
<section class="publications">
<div class="container">
    <h2 class="bg-black">Публикации</h2>
    <div class="publications__row">
        
        <?foreach($arResult['ITEMS'] as $dctItem):?>
        <div class="publications__el">
            <div class="publications__item">
                <div class="publications__head">
                  <p><?=FormatDate('j F Y',MakeTimeStamp($dctItem['ACTIVE_FROM'], 'DD.MM.YYYY HH:MI:SS'))?></p>
                  <div class="publications__logo" style="background-image: url(<?=$dctItem['PREVIEW_PICTURE']['SRC']?>)"></div>
                </div>
                <p class="publications__info"><?=$dctItem['PREVIEW_TEXT']?></p>
                <?if($dctItem['PROPERTY_URL_VALUE']):?>
                <div class="publications__link">
                    <a class="arrow" href="<?=$dctItem['PROPERTY_URL_VALUE']?>" target="_blank">Подробнее<span></span></a>
                </div>
                <?endif?>
            </div>
        </div>
        <?endforeach?>
    </div>
</div>
</section>
<?endif?>