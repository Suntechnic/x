<?php
$dctJsConfig = include('js/config.php');
if ($dctJsConfig) {
    if ($dctJsConfig['rel']) \Bitrix\Main\UI\Extension::load($dctJsConfig['rel']);

    \Bitrix\Main\Page\Asset::getInstance()->addJs($templateFolder.'/js/'.$dctJsConfig['js']);
    \Bitrix\Main\Page\Asset::getInstance()->addCss($templateFolder.'/js/'.$dctJsConfig['css']);
}

if (\Bitrix\Main\Loader::includeModule('currency')) {
    $currencyFormat = \CCurrencyLang::GetFormatDescription($arResult['BASE_LANG_CURRENCY']);
    $lstCurrencies = array(
            array(
                    'CURRENCY' => $arResult['BASE_LANG_CURRENCY'],
                    'FORMAT' => array(
                        'FORMAT_STRING' => $currencyFormat['FORMAT_STRING'],
                        'DEC_POINT' => $currencyFormat['DEC_POINT'],
                        'THOUSANDS_SEP' => $currencyFormat['THOUSANDS_SEP'],
                        'DECIMALS' => $currencyFormat['DECIMALS'],
                        'THOUSANDS_VARIANT' => $currencyFormat['THOUSANDS_VARIANT'],
                        'HIDE_ZERO' => $currencyFormat['HIDE_ZERO']
                    )
                )
        );
	?>
	<script>
		BX.Currency.setCurrencies(<?=CUtil::PhpToJSObject($lstCurrencies, false, true, true);?>);
	</script>
	<?php
}

