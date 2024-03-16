<?
define('NEED_AUTH',true);
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Personal');
$APPLICATION->SetPageProperty('title','Personal account info');
?> 
<section class="lk">
    <div class="container container--type-5">
        <div class="row">
            <div class="col-lg-3 order-lg-1 order-2">
                <?include(DEFAULT_TEMPLATE_PATH.'/includes/personal-menu.php');?>
            </div>

            <div class="col-lg order-lg-2 order-1 lk-content mb-5 mb-lg-0">
                
            </div>
        </div>
    </div>
</section>
<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');?>