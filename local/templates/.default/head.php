<meta http-equiv="Content-Type" content="text/html; charset="<?=LANG_CHARSET?>">
<title><?$APPLICATION->ShowTitle()?></title>


<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?if(APPLICATION_ENV == 'dev'):?><meta name="robots" content="noindex"><?endif?>

<?
\Bitrix\Main\Localization\Loc::setCurrentLang('ru');

$assets = \Bitrix\Main\Page\Asset::getInstance();

$assets->addCss('/local/assets/style/libs.min.css');
$assets->addCss('/local/assets/style/main.css');


$assets->addJs('/local/assets/js/libs.min.js');
$assets->addJs('/local/assets/js/script.js');


\Bitrix\Main\UI\Extension::load(['main.core', 'currency', 'x.core', 'app.vue.vuex']);

$APPLICATION->ShowHead();

// настройка формата валюты
if (\Bitrix\Main\Loader::includeModule('currency')) {
    $currencyFormat = \CCurrencyLang::GetFormatDescription('RUB');
    $lstCurrencies = array(
            array(
                    'CURRENCY' => 'RUB',
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

?>
<!-- og meta-->
<meta property="og:type"content="website">
<meta property="og:title" content="<?=$APPLICATION->ShowProperty('og_title')?>">
<meta property="og:description" content="<?=$APPLICATION->ShowProperty('og_description')?>">
<meta property="og:url" content="<?=$APPLICATION->ShowProperty('og_url')?>">
<meta property="og:image" content="<?=$APPLICATION->ShowProperty('og_image')?>">
<meta property="og:site_name" content="<?=GetMessage('SITE_NAME')?>">
<meta property="og:locale"content="<?=LANGUAGE_ID?>">