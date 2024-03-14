<meta http-equiv="Content-Type" content="text/html; charset="<?=LANG_CHARSET?>">
<title><?$APPLICATION->ShowTitle()?></title>


<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?if(APPLICATION_ENV == 'dev'):?><meta name="robots" content="noindex"><?endif?>

<?
\Bitrix\Main\Localization\Loc::setCurrentLang('en');

$assets = \Bitrix\Main\Page\Asset::getInstance();

$assets->addCss('/local/assets/fonts/gilroy/stylesheet.css');
$assets->addCss('/local/assets/css/bootstrap.min.css');
$assets->addCss('/local/assets/swiper/swiper-bundle.min.css');
$assets->addCss('/local/assets/css/nouislider.min.css'); ////////////////////
$assets->addCss('/local/assets/css/theme.css');

$assets->addJs('/local/assets/js/jquery.js');
$assets->addJs('/local/assets/js/fancybox.umd.js');
$assets->addJs('/local/assets/swiper/swiper-bundle.min.js');
$assets->addJs('/local/assets/js/wNumb.min.js');
$assets->addJs('/local/assets/js/nouislider.min.js'); //////////////////////////
$assets->addJs('https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js');
$assets->addJs('/local/assets/js/script.js');

\Bitrix\Main\UI\Extension::load(['main.core', 'currency', 'x.core', 'app.vue.vuex']);

$APPLICATION->ShowHead();

if (\Bitrix\Main\Loader::includeModule('currency')) {
    $currencyFormat = \CCurrencyLang::GetFormatDescription('USD');
    $lstCurrencies = array(
            array(
                    'CURRENCY' => 'USD',
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