<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
/**
 * @var array $arParams
 * @var array $arResult
 * @var $APPLICATION CMain
 */

if ($arParams["SET_TITLE"] == "Y")
{
	$APPLICATION->SetTitle(Loc::getMessage("SOA_ORDER_COMPLETE"));
}
?>
    <style>
        .breadcrumbs, .title {
            display: none!important;
        }
    </style>
<? if (!empty($arResult["ORDER"])): ?>

    <?
    $i = 0;
    $RBTHouseParam = '';
    foreach($arResult['ORDER']['BASKET'] as $arBasketItem) {
        $RBTHouseParam .= getMainID($arBasketItem['PRODUCT_ID']);
        if ($i != count($arResult['ORDER']['BASKET'])) {
            $RBTHouseParam .= ',';
        }
        $i++;
    }
    ?>

    <?$this->SetViewTarget('RBTHouse-content');?>
        <iframe src="https://creativecdn.com/tags?id=pr_FORltvWnlvRWb5A5ynMc_orderstatus2_<?=$arResult['ORDER']['PRICE'];?>_<?=$arResult['ORDER']['ID'];?>_<?=$RBTHouseParam;?>&amp;cd=default" width="1" height="1" scrolling="no" frameBorder="0" style="display: none;"></iframe>
    <?$this->EndViewTarget();?>

    <div class="thank-you center">
        <h1>Thank You!</h1>
        <div class="number-order">
            Order number
            <span><?=$arResult["ORDER"]['ACCOUNT_NUMBER'];?></span>
        </div>
        <?
		
        if ($arResult["ORDER"]["IS_ALLOW_PAY"] === 'Y')
        {
            if (!empty($arResult["PAYMENT"]))
            {
                foreach ($arResult["PAYMENT"] as $payment)
                {
                    if ($payment["PAID"] != 'Y')
                    {
                        if (!empty($arResult['PAY_SYSTEM_LIST'])
                            && array_key_exists($payment["PAY_SYSTEM_ID"], $arResult['PAY_SYSTEM_LIST'])
                        )
                        {
                            $arPaySystem = $arResult['PAY_SYSTEM_LIST_BY_PAYMENT_ID'][$payment["ID"]];

                            if (empty($arPaySystem["ERROR"]))
                            {
                                ?>
                                <br /><br />

                                <table class="sale_order_full_table">
                                    <tr>
                                        <td class="ps_logo">
                                            <div class="pay_name"><?=Loc::getMessage("SOA_PAY") ?></div>
                                            <?=CFile::ShowImage($arPaySystem["LOGOTIP"], 100, 100, "border=0\" style=\"width:100px\"", "", false) ?>
                                            <div class="paysystem_name"><?=$arPaySystem["NAME"] ?></div>
                                            <br/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <? if ($arPaySystem["ACTION_FILE"] <> '' && $arPaySystem["NEW_WINDOW"] == "Y" && $arPaySystem["IS_CASH"] != "Y"): ?>
                                                <?
                                                $orderAccountNumber = urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]));
                                                $paymentAccountNumber = $payment["ACCOUNT_NUMBER"];
                                                ?>
                                                <script>
                                                    window.open('<?=$arParams["PATH_TO_PAYMENT"]?>?ORDER_ID=<?=$orderAccountNumber?>&PAYMENT_ID=<?=$paymentAccountNumber?>');
                                                </script>
                                            <?=Loc::getMessage("SOA_PAY_LINK", array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".$orderAccountNumber."&PAYMENT_ID=".$paymentAccountNumber))?>
                                            <? if (CSalePdf::isPdfAvailable() && $arPaySystem['IS_AFFORD_PDF']): ?>
                                            <br/>
                                                <?=Loc::getMessage("SOA_PAY_PDF", array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".$orderAccountNumber."&pdf=1&DOWNLOAD=Y"))?>
                                            <? endif ?>
                                            <? else: ?>
                                                <?=$arPaySystem["BUFFERED_OUTPUT"]?>
                                            <? endif ?>
                                        </td>
                                    </tr>
                                </table>

                                <?
                            }
                            else
                            {
                                ?>
                                <span style="color:red;"><?=Loc::getMessage("SOA_ORDER_PS_ERROR")?></span>
                                <?
                            }
                        }
                        else
                        {
                            ?>
                            <span style="color:red;"><?=Loc::getMessage("SOA_ORDER_PS_ERROR")?></span>
                            <?
                        }
                    }
                }
            }
        } else {?>
            <strong><?=$arParams['MESS_PAY_SYSTEM_PAYABLE_ERROR']?></strong>
        <?}?>
    </div>


<? else: ?>

    <div class="thank-you center">
        <h1><?=Loc::getMessage("SOA_ERROR_ORDER")?></h1>
        <p>
            <?=Loc::getMessage("SOA_ERROR_ORDER_LOST", ["#ORDER_ID#" => htmlspecialcharsbx($arResult["ACCOUNT_NUMBER"])])?>
            <?=Loc::getMessage("SOA_ERROR_ORDER_LOST1")?>
        </p>
    </div>

<? endif ?>
