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
<div class="row mb-3">
    <?foreach($arResult['ITEMS'] as $dctItem):?>
    <div class="col-lg-4 col-md-6 news-item-col">
        <?include('template.item.php');?>
    </div>
    <?endforeach?>
</div>

<div class="d-flex justify-content-center mb-5">
    <?=$arResult['NAV_STRING']?>
</div>
<?endif?>

