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

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");

$PageUrlPrefix = $arResult["sUrlPath"].'?'.$strNavQueryString.'PAGEN_'.$arResult["NavNum"].'=';
?>




<div class="pagination">
    
    <a 
            href="<?=$PageUrlPrefix?><?=($arResult['NavPageNomer']-1)?>" 
            class="pagination-btn<?if($arResult['NavPageNomer'] < 2):?> pagination-disabled<?endif?>"
        >
        <svg width="8" height="14" viewBox="0 0 8 14" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M7.04004 1L1.00004 7.01L7.04004 13.02" stroke-width="1.5"
                stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </a>
    <div class="pagination-pages">
        <?for($I=$arResult["nStartPage"]; $I<$arResult["nEndPage"]+1; $I++):?>
        <a 
                href="<?=$PageUrlPrefix?><?=$I?>" 
                class="pagination-link<?if($arResult['NavPageNomer'] == $I):?> active<?endif?>"><?=$I?></a>
        <?endfor?>
    </div>
    <a 
            href="<?=$PageUrlPrefix?><?=$arResult['nEndPage']?>"
            class="pagination-btn<?if($arResult['NavPageNomer'] >= $arResult["nEndPage"]):?> pagination-disabled<?endif?>"
        >
        <svg width="8" height="14" viewBox="0 0 8 14" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M1 13.02L7.04 7.01002L1 1.00002" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" />
        </svg>

    </a>
</div>
