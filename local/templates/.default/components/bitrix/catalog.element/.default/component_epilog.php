<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

/**
 * @var array $templateData
 * @var array $arParams
 * @var string $templateFolder
 * @global CMain $APPLICATION
 */

$dctJsConfig = include('js/config.php');
if ($dctJsConfig) {
    if ($dctJsConfig['rel']) \Bitrix\Main\UI\Extension::load($dctJsConfig['rel']);

    \Bitrix\Main\Page\Asset::getInstance()->addJs($templateFolder.'/js/'.$dctJsConfig['js']);
    \Bitrix\Main\Page\Asset::getInstance()->addCss($templateFolder.'/js/'.$dctJsConfig['css']);
}

\Bitrix\Main\UI\Extension::load(['app.vue.components.favorites.button']);