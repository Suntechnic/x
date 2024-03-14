<?
use Bitrix\Iblock\SectionPropertyTable;
foreach($arResult["ITEMS"] as $dctItem)
{
    
    if(empty($dctItem["VALUES"])
            || isset($dctItem["PRICE"])
        ) continue;

    if ($dctItem["DISPLAY_TYPE"] === SectionPropertyTable::NUMBERS_WITH_SLIDER
            && ($dctItem["VALUES"]["MAX"]["VALUE"] - $dctItem["VALUES"]["MIN"]["VALUE"] <= 0)
        ) continue;
    ?>
    <div class="filter-item">
        <div class="filter-item__title">
            <?=$dctItem["NAME"]?>
        </div>
        <div class="filter-item__content">
            <div class="filter-checkbox-list">
                <?foreach($dctItem["VALUES"] as $dctItemValue):?>
                <label for="<?=$dctItemValue["CONTROL_ID"] ?>" class="checkbox">
                    <input type="checkbox"
                            value="<?=$dctItemValue["HTML_VALUE"] ?>"
                            name="<?=$dctItemValue["CONTROL_NAME"] ?>"
                            id="<?=$dctItemValue["CONTROL_ID"] ?>"
                            <?=$dctItemValue["CHECKED"]? 'checked="checked"': '' ?>
                            onclick="smartFilter.click(this)"
                        >
                    <div class="checkbox__input"></div>
                    <div class="checkbox__label"><?=$dctItemValue["VALUE"] ?></div>
                </label>
                <?endforeach;?>
            </div>
        </div>
    </div>
<?}?>