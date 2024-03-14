<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

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



$context = Bitrix\Main\Application::getInstance()->getContext();
$request = $context->getRequest();
global $USER;

if ($request->get('ORDER_ID') <> '') {
	include(Bitrix\Main\Application::getDocumentRoot().$templateFolder.'/confirm.php');
} elseif ($arParams['DISABLE_BASKET_REDIRECT'] === 'Y' && $arResult['SHOW_EMPTY_BASKET']) {
    include(Bitrix\Main\Application::getDocumentRoot().$templateFolder.'/empty.php');
} else {


	$arResult['JS_DATA']['LOCATION'] = [];
	
	foreach ($arResult['ORDER_PROP']['USER_PROPS_Y'] as $arItem) {
		if ($arItem['CODE'] == 'LOCATION') {
			foreach ($arItem['VARIANTS'] as $item) {
				if (!empty($item['CITY_NAME'])) {
					$arResult['JS_DATA']['LOCATION'][$item['CITY_NAME']] = $item['CODE'];
				}
			}
		}
	}
	
	$signer = new \Bitrix\Main\Security\Sign\Signer;
	$signedParams = $signer->sign(base64_encode(serialize($arParams)), 'sale.order.ajax');
	
	//\Kint::dump($arResult['JS_DATA']);
	
	$arJsonData = [
		'ajaxUrl' => \CUtil::JSEscape($component->getPath().'/ajax.php'),
		'signedParamsString' => \CUtil::JSEscape($signedParams),
		'arResult' => $arResult['JS_DATA'],
		'hashBasket' => \App\Basket\Helper::hash((new \App\Basket\Operator)->getBxBasket())
	];

    //\Kint\Kint::dump($arResult,$arParams);

    $router = \Bitrix\Main\Application::getInstance()->getRouter();
	?>

    <section class="checkout-page" style="position:relative" vue="Order">
        
        <script type="extension/settings" name="initdata"><?=json_encode($arJsonData)?></script>

        <div vue-slot="go2cart">
            <div class="mb-4">
                <a href="<?=$router->route('cart');?>" class="back-link">
                    <span>Back to cart</span>
                </a>
            </div>
        </div>


        <div vue-slot="auth">
            <div class="small-text">
                Have an account? <a href="<?=$router->route('personal');?>">Log in</a>
            </div>
        </div>


        <div vue-slot="expresscheckout">
            <div class="express-checkout">
                <span>Express checkout</span>
                <div class="express-checkout-logo">
                    <img src="/local/assets/img/paypal.svg" alt="paypal">
                    <img src="/local/assets/img/apple-pay.svg" alt="apple pay">
                </div>
            </div>
        </div>

    </section>
    
    <?
}
?>