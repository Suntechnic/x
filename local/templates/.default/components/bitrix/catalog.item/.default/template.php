<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogProductsViewedComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);

$dctItem = $arResult['ITEM'];
$arMinPrice = $dctItem['OFFERS'][$dctItem['MIN_PRICE_INDEX']['OFFER']]['ITEM_PRICES'][$dctItem['MIN_PRICE_INDEX']['PRICE']];
if ($dctItem):?>
<div class="product-grid-item product-grid-item--type-2">

    <?if ($dctItem['DISPLAY_PROPERTIES']['SEO_MARK']):?>
    <div class="product-grid-item__tag-list">
        <?foreach ($dctItem['DISPLAY_PROPERTIES']['SEO_MARK']['VALUE'] as $Name): ?>
        <div class="product-grid-item__tag tag_<?=preg_replace('/[^ a-z\d]/ui', '',strtolower($Name))?>"><?=$Name?></div>
        <?endforeach?>
    </div>
    <?endif?>

    <div 
            class="product-grid-item__images product-grid-item__images--ratio-100-122 js-product-grid-images"
            data-current-image="0"
        >

        <?if($dctItem['DISPLAY_PROPERTIES']['RATING']):?>
        <?$APPLICATION->IncludeComponent(
                'x:x',
                'rating',
                Array(
                        'TEMPLATE' => [
                                'RATING_VALUE' => $dctItem['DISPLAY_PROPERTIES']['RATING']['VALUE']
                            ]
                    )
            );?>
        <?endif?>

        <div class="product-grid-item__image js-product-grid-image active">
            <a href="<?=$dctItem['DETAIL_PAGE_URL']?>">
                <?if($dctItem['PREVIEW_PICTURE']):?>
                <img alt="Image <?=$dctItem['NAME'];?>" src="<?=$dctItem['PREVIEW_PICTURE']['SRC'];?>">
                <?endif?>
            </a>
        </div>
    </div>
    <div class="product-grid-item__action">
        <div class="d-flex align-items-center">
            <div class="product-grid-item__wishlist">
                <span class="open-tooltip">
                    <span
                        class="custom-tooltip">Add to wishlist</span>
                        <span vue="FavoriteButton" data-elementid="<?=$dctItem['ID']?>"></span>
                </span>
            </div>
            <?/*
            <div class="product-grid-item__compare">
                <a href="#" class="open-tooltip"><span
                        class="custom-tooltip">Add to cart</span><i
                        class="lnil lnil-cart-alt"></i>
                </a>
            </div>
            */?>
        </div>
    </div>
    <div class="product-grid-item__feature">Round</div>
    <div class="product-grid-item__name">
        <a href="<?=$dctItem['DETAIL_PAGE_URL']?>"><?=$dctItem['NAME'];?></a>
    </div>
    <div class="product-grid-item__price">
        <span class="product-grid-item__price-new">From <?=$arMinPrice['PRINT_PRICE']?></span>
    </div>
</div>
<?endif?>