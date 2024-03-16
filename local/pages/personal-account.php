<?
define('NEED_AUTH',true);
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Personal');
$APPLICATION->SetPageProperty('title','Personal account');

\Bitrix\Main\UI\Extension::load([
        'app.vue.components.form.account'
    ]);
?> 
<section class="lk">
    <div class="container container--type-5">
        <div class="row">
            <div class="col-lg-3 order-lg-1 order-2">
                <?include(DEFAULT_TEMPLATE_PATH.'/includes/personal-menu.php');?>
            </div>

            <div class="col-lg order-lg-2 order-1 lk-content mb-5 mb-lg-0">
                <?include(DEFAULT_TEMPLATE_PATH.'/includes/personal-back.php');?>
                <h1 class="title-subtitle title-subtitle--big mb-1">
                    Account
                </h1>
                <p class="mb-4">
                    Your name, email and password for your account are listed below.
                    Use the "Edit" buttons to make changes.
                </p>

                <div vue="FormAccount" data-userid="<?=\Bitrix\Main\Engine\CurrentUser::get()->getId()?>"></div>

            </div>
        </div>
    </div>
</section>
<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');?>