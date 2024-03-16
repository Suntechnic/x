<?
define('NEED_AUTH',true);
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Personal');
$APPLICATION->SetPageProperty('title','Personal');
$router = \Bitrix\Main\Application::getInstance()->getRouter();
$ss = \Bxx\Stringstorage::getInstance();
$phone = \Bitrix\Main\PhoneNumber\Parser::getInstance()->parse($ss->getStringVal('phone'));

$user = \Bitrix\Main\Engine\CurrentUser::get();
?> 

<section class="lk">
    <div class="container container--type-5">
        <div class="row">
            <div class="col-lg-3 order-lg-1 order-2">
                <?include(DEFAULT_TEMPLATE_PATH.'/includes/personal-menu.php');?>
            </div>
            
            <div class="col-lg order-lg-2 order-1 lk-content mb-5 mb-lg-0">
                <h1 class="title title-lk">
                    Hello, <?=$user->getFullName();?>. <br>Welcome to your account!
                </h1>
                <h2 class="title-subtitle">Recent Orders</h2>
                <p>We don’t have any recent orders for your account. Orders placed today may not appear
                    immediately. If you have placed an order within the last 30 days but don’t see it here,
                    please return shortly or call us at <a href="tel:<?=$phone->getRawNumber(\Bitrix\Main\PhoneNumber\Format::E164);?>"><?=$phone->getRawNumber();?></a> .

                </p>
                <p>For orders placed prior to 30 days ago, visit your <a href="<?=$router->route('personal/orders');?>">Orders & Returns</a> page.</p>
            </div>
        </div>
    </div>
</section>
<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');?>