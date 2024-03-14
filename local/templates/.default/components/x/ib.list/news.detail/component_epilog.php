<?php
if ($arResult['ITEM']) {
    $APPLICATION->AddChainItem('News','/news/');
    $APPLICATION->AddChainItem($arResult['ITEM']['NAME']);

    // установка заголовка
    $dctSeo = $arResult['ITEM']['SEO'];
    
    if ($dctSeo['ELEMENT_META_TITLE']) {
       $APPLICATION->SetPageProperty('title', $dctSeo['ELEMENT_META_TITLE'], ['COMPONENT_NAME' => $component->getName()]);
    } else {
       $APPLICATION->SetPageProperty('title', $arResult['ITEM']['NAME'], ['COMPONENT_NAME' => $component->getName()]);
    }
    
    if ($dctSeo['ELEMENT_META_DESCRIPTION']) {
       $APPLICATION->SetPageProperty('description', $dctSeo['ELEMENT_META_DESCRIPTION'], ['COMPONENT_NAME' => $component->getName()]);
    } else {
       $APPLICATION->SetPageProperty('description', $arResult['ITEM']['NAME'], ['COMPONENT_NAME' => $component->getName()]);
    }
} else {
    \Bitrix\Iblock\Component\Tools::process404(
            'Not news', //Сообщение
            true, // Нужно ли определять 404-ю константу
            true, // Устанавливать ли статус
            true, // Показывать ли 404-ю страницу
            false // Ссылка на отличную от стандартной 404-ю
        );
}