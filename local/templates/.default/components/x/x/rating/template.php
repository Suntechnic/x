<?
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



$Rating = $component->arParamsTemplate['RATING_VALUE'];
// приведем рейтинг к половинкам
$Rating = round($Rating*2)/2;
?>
<div class="review-item-stars">
    <?for($RI=0; $RI<5; $RI++):?>
    <div 
            class="review-star
                    <?if ($Rating<=$RI):?>
                    review-star--clear
                    <?elseif($Rating<=$RI+0.5):?>
                    review-star--only
                    <?endif?>
                "
        ></div>
    <?endfor?>
    <!-- <div class="review-star"></div>
    <div class="review-star"></div>
    <div class="review-star"></div>
    <div class="review-star review-star--only"></div>
    <div class="review-star review-star--clear"></div> -->

    <div class="rating-product__count">
        <?=$Rating?> 
        <?if($component->arParamsTemplate['RATING_NUM']):?>
        <?=$component->arParamsTemplate['RATING_NUM']?>
        <?endif?>
    </div>
</div>