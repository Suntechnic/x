<?foreach($arResult["ITEMS"] as $key=>$arItem): if (!isset($arItem["PRICE"])) continue;
    $key = $arItem["ENCODED_ID"];
    if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
        continue;

    $precision = 0;
    $step_num = 4;
    $step = ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / $step_num;
    $prices = array();
    if (Bitrix\Main\Loader::includeModule("currency")) {
        for ($i = 0; $i < $step_num; $i++)
        {
            $prices[$i] = CCurrencyLang::CurrencyFormat($arItem["VALUES"]["MIN"]["VALUE"] + $step*$i, $arItem["VALUES"]["MIN"]["CURRENCY"], false);
        }
        $prices[$step_num] = CCurrencyLang::CurrencyFormat($arItem["VALUES"]["MAX"]["VALUE"], $arItem["VALUES"]["MAX"]["CURRENCY"], false);
    } else {
        $precision = $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0;
        for ($i = 0; $i < $step_num; $i++)
        {
            $prices[$i] = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step*$i, $precision, ".", "");
        }
        $prices[$step_num] = number_format($arItem["VALUES"]["MAX"]["VALUE"], $precision, ".", "");
    }

    ?>
    <div class="filter-item">
        <div class="filter-item__title pb-2">
            Price
        </div>

        <div class="filter-item__content">
            <div 
                    id="filter-price"
                    data-to="<?=$arItem["VALUES"]["MIN"]["HTML_VALUE"]?$arItem["VALUES"]["MIN"]["HTML_VALUE"]:$arItem["VALUES"]["MIN"]["VALUE"]?>"
                    data-from="<?=$arItem["VALUES"]["MAX"]["HTML_VALUE"]?$arItem["VALUES"]["MAX"]["HTML_VALUE"]:$arItem["VALUES"]["MAX"]["VALUE"]?>"
                    data-min="<?=$arItem["VALUES"]["MIN"]["VALUE"]?>" 
                    data-max="<?=$arItem["VALUES"]["MAX"]["VALUE"]?>"
                >
                <input
                        class="min-price"
                        type="hidden"
                        name="<?=$arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
                        id="<?=$arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
                        value="<?=$arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
                        size="5"
                        onkeyup="smartFilter.keyup(this)"
                    />
                <input
                        class="max-price"
                        type="hidden"
                        name="<?=$arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
                        id="<?=$arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
                        value="<?=$arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
                        size="5"
                        onkeyup="smartFilter.keyup(this)"
                    />
            </div>
            <div class="priceValue">
                Price: $ <span></span> - $ <span></span>
            </div>
            
            
        </div>
        
    </div>
    <?$arJsParams = array(
            "leftSlider" => 'left_slider_'.$key,
            "rightSlider" => 'right_slider_'.$key,
            "tracker" => "drag_tracker_".$key,
            "trackerWrap" => "drag_track_".$key,
            "minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
            "maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
            "minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
            "maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
            "curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
            "curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
            "fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ,
            "fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
            "precision" => $precision,
            "colorUnavailableActive" => 'colorUnavailableActive_'.$key,
            "colorAvailableActive" => 'colorAvailableActive_'.$key,
            "colorAvailableInactive" => 'colorAvailableInactive_'.$key,
        );/*?>
    <script type="text/javascript">
        BX.ready(function(){
            window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
        });
    </script><?*/?>
    <?endforeach;?>
    