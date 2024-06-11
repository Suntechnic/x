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
<div class="swiper swiper-gen">
    <div class="swiper-wrapper">
        <?foreach($arResult['ITEMS'] as $dctItem):?>
        <div class="swiper-slide" style="background-Image:url('<?=$dctItem['DETAIL_PICTURE']['SRC']?>');">
            <div class="swsl-text w-50 d-flex flex-column justify-content-center h-100">
                <div class="swsl-h1">
                    <?=$dctItem['NAME']?>
                </div>
                <?if($dctItem['DETAIL_TEXT']):?>
                <div class="swsl-t">
                    <?=$dctItem['DETAIL_TEXT']?>
                </div>
                <?endif?>
                <?if($dctItem['PROPERTY_LINK_VALUE']):?>
                <div class="swsl-bs mt-4">
                    <a href="<?=$dctItem['PROPERTY_LINK_VALUE']?>" class="button">More info</a>
                </div>
                <?endif?>
            </div>
        </div>
        <?endforeach?>
    </div>
    <div class="swiper-pagination"></div>
    <div class="swiper-button-prev d-none d-lg-block">
        <svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_0_1)">
            <path d="M28.52 20.98H13.53" stroke="#C8AF86" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M19.52 14.99L13.48 21L19.52 27.01" stroke="#C8AF86" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </g>
            <circle cx="21" cy="21" r="20" stroke="#C8AF86" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <defs>
            <clipPath id="clip0_0_1">
            <rect width="24" height="24" fill="white" transform="matrix(-1 0 0 1 33 9)"/>
            </clipPath>
            </defs>
        </svg>
    </div>
    <div class="swiper-button-next d-none d-lg-block">
        <svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_0_1)">
            <path d="M13.48 20.98H28.47" stroke="#C8AF86" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M22.48 14.99L28.52 21L22.48 27.01" stroke="#C8AF86" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </g>
            <circle cx="20" cy="20" r="20" transform="matrix(-1 0 0 1 41 1)" stroke="#C8AF86" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <defs>
            <clipPath id="clip0_0_1">
            <rect width="24" height="24" fill="white" transform="translate(9 9)"/>
            </clipPath>
            </defs>
        </svg>
    </div>
</div>
<?endif?>

