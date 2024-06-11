<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<section class="auth-main">
    <div class="container container--type-5">
        <div class="auth-form">


            <?
            if (!empty($arParams["~AUTH_RESULT"])) {
                ShowMessage($arParams["~AUTH_RESULT"]);
            }

            if (!empty($arResult['ERROR_MESSAGE'])) {
                ShowMessage($arResult['ERROR_MESSAGE']);
            }
            ?>

            <?if($arResult["AUTH_SERVICES"]):?>
            <?
            $APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "",
                array(
                    "AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
                    "CURRENT_SERVICE" => $arResult["CURRENT_SERVICE"],
                    "AUTH_URL" => $arResult["AUTH_URL"],
                    "POST" => $arResult["POST"],
                    "SHOW_TITLES" => $arResult["FOR_INTRANET"]?'N':'Y',
                    "FOR_SPLIT" => $arResult["FOR_INTRANET"]?'Y':'N',
                    "AUTH_LINE" => $arResult["FOR_INTRANET"]?'N':'Y',
                ),
                $component,
                array("HIDE_ICONS"=>"Y")
            );
            ?>
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
            <?endif?>
            

            <div class="text-center mb-3">
                <div class="title title--lk mb-1">Login</div>
                <div class="log-subtitle">If you have an account with us, please log in.</div>
            </div>
            <form name="form_auth" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
                <input type="hidden" name="AUTH_FORM" value="Y" />
                <input type="hidden" name="TYPE" value="AUTH" />
                <?if ($arResult["BACKURL"] <> ''):?>
                <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
                <?endif?>
                <?foreach ($arResult["POST"] as $key => $value):?>
                <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
                <?endforeach?>

                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="" class="input">
                            <input type="text" name="USER_LOGIN">
                            <span class="input__label">
                                Login
                            </span>
                        </label>
                    </div>

                    <div class="col-12 mb-3">
                        <label for="" class="input">
                            <input type="password" name="USER_PASSWORD">
                            <span class="input__label">
                                Password
                            </span>
                        </label>
                    </div>

                    <?if($arResult["CAPTCHA_CODE"]):?>
                    <div class="col-12 mb-3">
                        <label for="" class="input">
                            <input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
                            <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
                            <input class="bx-auth-input form-control" type="text" name="captcha_word" value="" autocomplete="off" />
                            <span class="input__label">
                                <?=GetMessage("AUTH_CAPTCHA_PROMT")?>
                            </span>
                        </label>
                    </div>
                    <?endif;?>

                </div>

                <?if ($arResult["STORE_PASSWORD"] == "Y"):?>
                <label for="remember-1" class="checkbox mb-3">
                    <input type="checkbox" id="USER_REMEMBER" name="USER_REMEMBER" value="Y">
                    <div class="checkbox__input"></div>
                    <div class="checkbox__label">Remember me</div>
                </label>
                <?endif?>
                
                <div class="log-smalltext mb-4">By signing in to your account, you agree to our <a
                        href="#">PrivacyPolicy</a> <br> and <a href="#">Terms of Service</a>.
                </div>

                
                <div class="text-center">
                    <button class="second-button auth-button mb-3">Sign in</button>
                    <?if ($arParams["NOT_SHOW_LINKS"] != "Y"):?>
                    <?if($arResult["NEW_USER_REGISTRATION"] == "Y" && $arParams["AUTHORIZE_REGISTRATION"] != "Y"):?>
                    <div class="log-subtitle mb-2">Don’t have an account? <a href="<?=$arResult["AUTH_REGISTER_URL"]?>" rel="nofollow">Create an account</a></div>
                    <?endif?>
                    <div class="log-smalltext"><a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow">Forgot your password?</a></div>
                    <?endif?>
                </div>
            </form>


        </div>

    </div>
</section>

<script type="text/javascript">
<?if ($arResult["LAST_LOGIN"] <> ''):?>
try{document.form_auth.USER_PASSWORD.focus();}catch(e){}
<?else:?>
try{document.form_auth.USER_LOGIN.focus();}catch(e){}
<?endif?>
</script>


