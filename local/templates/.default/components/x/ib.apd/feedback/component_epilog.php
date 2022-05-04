<?
//Kint::dump($_REQUEST,$_FILES);

if($arResult['RESULT'] && 0 == $arResult['RESULT']['STATUS'] && $arResult['RESULT']['ID']) {
    LocalRedirect($APPLICATION->GetCurPageParam('ORDER='.$arResult['RESULT']['ID']));
}