<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Registration');
$APPLICATION->SetPageProperty('title','Registration');
?> 

<section class="auth-main">
    <div class="container container--type-5">
        <?$APPLICATION->IncludeComponent("bitrix:main.register","",Array(
                    "USER_PROPERTY_NAME" => "", 
                    "SHOW_FIELDS" => Array("NAME","LAST_NAME"), 
                    "REQUIRED_FIELDS" => Array("NAME"), 
                    "AUTH" => "Y", 
                    "USE_BACKURL" => "Y", 
                    "SUCCESS_PAGE" => "", 
                    "SET_TITLE" => "N", 
                    "USER_PROPERTY" => Array(), 
                    "VARIABLE_ALIASES" => Array()
                )
            );?>
    </div>
</section>
<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');?>