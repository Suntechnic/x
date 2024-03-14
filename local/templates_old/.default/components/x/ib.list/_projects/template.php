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

$lstBacklight = [
        'light-blue',
        'blue',
        'pink',
        'violet'
    ];

?>
<div class="container">
    <h2><span class="bg-black">Мы воплощаем яркие идеи</span><span class="bg-black">и технологичные  решения</span></h2>
    <p class="sub-title">при стабильно высоком качестве работ</p>
    <?foreach($arResult['ITEMS'] as $i=>$dctItem): //Kint::dump($dctItem);?>
        <div class="ideas__item">
            <div class="ideas__grid <?if($i%2):?>ideas__grid--reverse<?endif?>">
                <div class="ideas__image">
                    <h3><a
                            <?if ($dctItem['PROPERTY_URL_VALUE']):?>
                                href="<?=$dctItem['PROPERTY_URL_VALUE']?>"
                                target="_blank"
                            <?else:?>
                                href="<?=$dctItem['DETAIL_PAGE_URL']?>"
                            <?endif?>
                            onmouseenter="this.closest('.ideas__item').classList.add('is-hover');"
                            onmouseleave="this.closest('.ideas__item').classList.remove('is-hover');"
                        ><?=$dctItem['PROPERTY_TITLE_VALUE']?></a></h3>
                    <a
                            class="ideas__image-container"
                            <?if ($dctItem['PROPERTY_URL_VALUE']):?>
                                href="<?=$dctItem['PROPERTY_URL_VALUE']?>"
                                target="_blank"
                            <?else:?>
                                href="<?=$dctItem['DETAIL_PAGE_URL']?>"
                            <?endif?>
                            onmouseenter="this.closest('.ideas__item').classList.add('is-hover');"
                            onmouseleave="this.closest('.ideas__item').classList.remove('is-hover');"
                        >
                        <div class="ideas__image-placeholder">
                            <img src="<?=P_IMAGES?>/idea-placeholder.png" width="100%" height="100%" alt="">
                            <div class="dot <?=$lstBacklight[$i%4]?>"></div>
                        </div>
                        <img
                                class="ideas__image-main"
                                width="100%" height="100%"
                                style="<?=$dctItem['PROPERTY_IMAGESTYLE_VALUE']?>"
                                src="<?=$dctItem['PREVIEW_PICTURE']?>"
                                <?if($arParams['TEMPLATE']['LOAD']):?>loading="<?=$arParams['TEMPLATE']['LOAD']?>"<?endif?>
                                alt=""
                            >
                    </a>
                </div>
                <div class="ideas__info">
                    <div class="ideas__info-container">
                        <a
                                <?if ($dctItem['PROPERTY_URL_VALUE']):?>
                                    href="<?=$dctItem['PROPERTY_URL_VALUE']?>"
                                    target="_blank"
                                <?else:?>
                                    href="<?=$dctItem['DETAIL_PAGE_URL']?>"
                                <?endif?>
                                onmouseenter="this.closest('.ideas__item').classList.add('is-hover');"
                                onmouseleave="this.closest('.ideas__item').classList.remove('is-hover');"
                            ><h3><?=$dctItem['PROPERTY_TITLE_VALUE']?></h3></a>
                        <p><?=$dctItem['PROPERTY_SUBTITLE_VALUE']?></p><a
                                class="arrow"
                                <?if ($dctItem['PROPERTY_URL_VALUE']):?>
                                    href="<?=$dctItem['PROPERTY_URL_VALUE']?>"
                                    target="_blank"
                                <?else:?>
                                    href="<?=$dctItem['DETAIL_PAGE_URL']?>"
                                <?endif?>
                                onmouseenter="this.closest('.ideas__item').classList.add('is-hover');"
                                onmouseleave="this.closest('.ideas__item').classList.remove('is-hover');"
                            >Подробнее<span></span></a>
                    </div>
                </div>
            </div>
        </div>
    <?endforeach?>
</div>