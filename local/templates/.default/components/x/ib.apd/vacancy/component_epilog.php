<?
//Kint::dump($_REQUEST,$_FILES);

if($arResult['RESULT'] && 0 == $arResult['RESULT']['STATUS'] && $arResult['RESULT']['ID']) {
    LocalRedirect($APPLICATION->GetCurPageParam('ID='.$arResult['RESULT']['ID']));
}