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
<div class="row">
    <?foreach ($arResult['SECTIONS'] as $dctItem): ?>
    <div class="col-md-3 col-6 mb-4">
        <div class="product-grid-item product-grid-item--type-2">
            <div 
                    class="product-grid-item__images product-grid-item__images--ratio-100-122 js-product-grid-images"
                    data-current-image="0"
                >
                <div class="product-grid-item__image js-product-grid-image active">
                    <a href="<?=$dctItem['SECTION_PAGE_URL']?>">
                        <?if($dctItem['PICTURE']):?>
                        <img alt="Image <?=$dctItem['NAME'];?>" src="<?=$dctItem['PICTURE']['SRC'];?>">
                        <?endif?>
                    </a>
                </div>
            </div>
        </div>

        <div class="product-grid-item__name">
            <a href="<?=$dctItem['SECTION_PAGE_URL']?>"><?=$dctItem['NAME'];?></a>
        </div>

    </div>
    <?endforeach?>
</div>