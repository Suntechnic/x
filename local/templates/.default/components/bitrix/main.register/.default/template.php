<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

// проверка валидности формы
if (
        implode(':',$arResult['SHOW_FIELDS']) != 'LOGIN:EMAIL:PASSWORD:CONFIRM_PASSWORD:NAME:LAST_NAME'
        || $arResult["SECURE_AUTH"]
    ):?>
<p>Invalid component settings</p>
<?return; endif?>

<?if($USER->IsAuthorized()):?>
<p><?echo GetMessage("MAIN_REGISTER_AUTH")?></p>
<?else:?>
<div class="auth-form">
    
    <?/*
    <div class="auth-list">
        <a href="#" class="auth-item">
            <img src="img/social/fb.svg" alt="">
            <span>Continue with Facebook</span>
        </a>
        <a href="#" class="auth-item">
            <img src="img/social/google.svg" alt="">
            <span>Continue with Google</span>
        </a>
        <a href="#" class="auth-item">
            <img src="img/social/amazon.svg" alt="">
            <span>Continue with Amazon</span>
        </a>
    </div>
    */?>
    <div class="text-center mb-3">
        <div class="title title--lk mb-1">Registration</div>
        <div class="log-subtitle">Enter your information below to proceed. If you already have
            an account, please log in instead.</div>

        <?if (!empty($arResult["ERRORS"])):
            foreach ($arResult["ERRORS"] as $key => $error) {
                if (intval($key) == 0 && $key !== 0) {
                    $arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);
                }
            }
            ShowError(implode("<br />", $arResult["ERRORS"]));?>
        <?elseif($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):?>
        <p><?echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT")?></p>
        <?endif?>
    </div>
    <form method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data">
        <?if($arResult["BACKURL"] <> ''):?>
            <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
        <?endif;?>
        <div class="row">
            <div class="col-6 mb-3">
                <label for="" class="input">
                    <input type="text" name="REGISTER[NAME]" value="<?=$arResult['VALUES']['NAME']?>">
                    <span class="input__label">
                        First name
                    </span>
                </label>
            </div>
            <div class="col-6 mb-3">
                <label for="" class="input">
                    <input type="text" name="REGISTER[LAST_NAME]" value="<?=$arResult['VALUES']['LAST_NAME']?>">
                    <span class="input__label">
                        Last name
                    </span>
                </label>
            </div>
            <div class="col-12 mb-3">
                <label for="" class="input">
                    <input type="text" name="REGISTER[LOGIN]" value="<?=$arResult['VALUES']['LOGIN']?>">
                    <span class="input__label">
                        Login
                    </span>
                </label>
            </div>
            <div class="col-12 mb-3">
                <label for="" class="input">
                    <input type="email" name="REGISTER[EMAIL]" value="<?=$arResult['VALUES']['EMAIL']?>">
                    <span class="input__label">
                        Email address
                    </span>
                </label>
            </div>
            <div class="col-12 mb-3">
                <label for="" class="input">
                    <input type="password" name="REGISTER[PASSWORD]">
                    <span class="input__label">
                        Password
                    </span>
                    <?/*
                    <span class="input__icon">
                        <img src="img/eye_close.svg" alt="">
                    </span>
                    */?>
                </label>
            </div>
            <div class="col-12 mb-3">
                <label for="" class="input">
                    <input type="password" name="REGISTER[CONFIRM_PASSWORD]">
                    <span class="input__label">
                        Repeat password
                    </span>
                    <?/*
                    <span class="input__icon">
                        <img src="img/eye_close.svg" alt="">
                    </span>
                    */?>
                </label>
            </div>

            <?if ($arResult["USE_CAPTCHA"] == "Y"):?>
            <div class="col-12 mb-3">
                <input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
                <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />

                <label for="" class="input">
                    <input type="text" name="captcha_word" value="" autocomplete="off">
                    <span class="input__label">
                        <?=GetMessage("REGISTER_CAPTCHA_PROMT")?>
                    </span>
                    <?/*
                    <span class="input__icon">
                        <img src="img/eye_close.svg" alt="">
                    </span>
                    */?>
                </label>
            </div>
            <?endif?>

        </div>
        <?/*
        <label for="remember-1" class="checkbox mb-3">
            <input type="checkbox" id="remember-1" value="remember">
            <div class="checkbox__input"></div>
            <div class="checkbox__label">Subscribe for Newsletter</div>
        </label>
        */?>
        <div class="text-center">
            <input class="second-button reg-button mb-3" type="submit" name="register_submit_button" value="Creat an account" />
            <div class="log-subtitle mb-2">Already have an account? <a href="/personal/">Login</a></div>
        </div>
    </form>
<?endif?>
</div>