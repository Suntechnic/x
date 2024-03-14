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
<div class="inputs-grid">
    <?foreach($arResult['ITEMS'] as $dctItem):?>
    <div class="inputs-grid__el <?if(mb_strlen($dctItem['NAME']) < 9):?>inputs-grid__el--w25<?endif?>">
        <label class="input-check">
            <input type="checkbox" name="<?=$arParams['TEMPLATE']['NAME']?>" value="<?=$dctItem['ID']?>"><span><?=$dctItem['NAME']?></span>
        </label>
    </div>
    <?endforeach?>
</div>