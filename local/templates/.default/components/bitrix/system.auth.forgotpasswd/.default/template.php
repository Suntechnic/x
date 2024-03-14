<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
\Kint\Kint::dump($arResult,$arParams);
?>
<section class="auth-main">
    <div class="container container--type-5">
        <div class="auth-form">
            <div class="text-center mb-3">
                <div class="title title--lk mb-1"><?echo GetMessage("sys_forgot_pass_label")?></div>
                <?if ($arParams["AUTH_RESULT"]["TYPE"] == 'OK'):?>
                    <div class="log-subtitle">
                    Контрольная строка, а также ваши регистрационные данные были высланы на email. Пожалуйста, дождитесь письма, так как контрольная строка изменяется при каждом запросе.&lt;br&gt;
                    </div>
                <?endif?>
            </div>
            <form name="bform" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
                <?if ($arResult["BACKURL"] <> ''):?>
                <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
                <?endif;?>

                <input type="hidden" name="AUTH_FORM" value="Y">
	            <input type="hidden" name="TYPE" value="SEND_PWD">

                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="" class="input">
                            <input type="text" name="USER_LOGIN" value="<?=$arResult["USER_LOGIN"]?>" />
                            <input type="hidden" name="USER_EMAIL" />
                            <span class="input__label">
                                <?=GetMessage("sys_forgot_pass_login1")?>
                            </span>
                        </label>
                    </div>

                    <?if($arResult["USE_CAPTCHA"]):?>
                    <div class="col-12 mb-3">
                        <input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
                        <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
                        <label for="" class="input">
                            <input type="text" name="captcha_word" maxlength="50" value="" />
                            <span class="input__label">
                                <?echo GetMessage("system_auth_captcha")?>
                            </span>
                        </label>
                    </div>
                    <?endif?>
                </div>

                
                <div class="log-smalltext mb-4">
                    <?echo GetMessage("sys_forgot_pass_note_email")?>
                </div>

                <div class="text-center">
                    <button class="second-button auth-button mb-3">Sign in</button>
                </div>
            </form>
        </div>
    </div>
</section>

<script type="text/javascript">
document.bform.onsubmit = function(){document.bform.USER_EMAIL.value = document.bform.USER_LOGIN.value;};
document.bform.USER_LOGIN.focus();
</script>
