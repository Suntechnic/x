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

use Bitrix\Iblock\SectionPropertyTable;

$this->setFrameMode(true);


?>


<form 
        class="catalog-filter" 
        name="<?echo $arResult["FILTER_NAME"]."_form"?>" 
        action="<?echo $arResult["FORM_ACTION"]?>" 
        method="get" 
        class="smartfilter"
    >
    <div class="d-block">
        <div class="catalog-filter__header">
            <div class="catalog-filter-title">
                Filter Results
            </div>
            <div class="filter-close js-filter-close">

            </div>
        </div>
    </div>
    
    <div class="filter-list">
        <?include('template-prices.php');?>
        <?include('template-props.php');?>
    </div>  


    <div class="d-block">
        <div class="filter-bottom">
            <div class="row">
                <div class="col">
                    <input
                            class="third-button button w-100"
                            type="submit"
                            id="set_filter"
                            name="set_filter"
                            value="Apply"
                        />
                </div>
                <div class="col">
                    <input
                            class="button  w-100"
                            type="submit"
                            id="del_filter"
                            name="del_filter"
                            value="Clear all"
                        />
                </div>
            </div>
        </div>
    </div>
    

    <script type="text/javascript">
        var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
    </script>
</form>




