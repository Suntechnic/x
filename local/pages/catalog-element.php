<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Catalog');
$APPLICATION->SetPageProperty('title','Catalog');

$context = \Bitrix\Main\Application::getInstance()->getContext();
$request = $context->getRequest();
?> 

<?$APPLICATION->IncludeComponent(
        'bitrix:catalog.element',
        '',
        array_merge(\App\Catalog\Component::getParams(),[
            'SECTION_CODE' => $request->get('Section'),
            'ELEMENT_CODE' => $request->get('Element'),
            'ADD_SECTIONS_CHAIN' => 'Y',
            'ADD_ELEMENT_CHAIN' => 'Y'
        ])
    );?>

<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');?>