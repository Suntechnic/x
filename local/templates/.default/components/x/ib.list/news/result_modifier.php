<?

foreach ($arResult['ITEMS'] as $i=>$dctItem) {
    \Bxx\Helpers\IBlocks\Elements\Modifiers::illustrator($arResult['ITEMS'][$i]);
    \Bxx\Helpers\IBlocks\Elements\Modifiers::dater($arResult['ITEMS'][$i],['format'=>'F j Y']);
}
