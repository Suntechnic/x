<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
?>
<div class="step-page">
    <div class="step-page__header">
        <a class="logo header__logo" href="/">
            <img src="<?=SITE_TEMPLATE_PATH;?>/assets/images/img-logo.svg" alt="" width="140" height="28">
        </a>
        <a class="link-prev" href="/">
            <span>Вернуться назад</span>
        </a>
    </div>
    <div class="step-page__main">
        <div class="thank-you center">
            <h1><?=Loc::getMessage("EMPTY_BASKET_TITLE")?></h1>
            <a class="link-site" href="/">На главную</a>
        </div>
    </div>
</div>