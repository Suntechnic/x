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

<?if($arResult['ITEMS']):?>
<div class="other-news">
    <h2 class="title">
        Other News
    </h2>
    <div class="swiper swiper-other-news">
        <div class="swiper-wrapper">
            <?foreach($arResult['ITEMS'] as $dctItem):?>
            <div class="swiper-slide">
                <?include(__DIR__.'/../news/template.item.php');?>
            </div>
            <?endforeach?>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>
<?endif?>

