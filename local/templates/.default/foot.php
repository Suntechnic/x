<?php
$ss = \Bxx\Stringstorage::getInstance();
\Kint\Kint::dump(SITE_SERVER_NAME);
$Title = $ss->getStringVal('title');
$Description = $ss->getStringVal('description');
$dctPageProperties = [
        'title' => $Title,
        'description' => $Description,
        'og_title' => $Title,
        'og_description' => $Description,
        'og_url' => 'https://'.SITE_SERVER_NAME.\Bitrix\Main\Application::getInstance()->getContext()->getRequest()->getRequestUri(),
        'og_image' => 'https://'.SITE_SERVER_NAME.'/local/assets/images/og_image.jpg',
    ];

foreach ($dctPageProperties as $prop=>$val) {
    if (!$APPLICATION->GetPageProperty($prop)) $APPLICATION->SetPageProperty($prop,$val);
}