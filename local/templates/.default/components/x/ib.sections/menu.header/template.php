
<ul class="header__nav">
    <?foreach($arResult['ITEMS'] as $dctSection): if ($dctSection['IBLOCK_SECTION_ID']) continue; ?>
    <li>
        <a href="<?=$dctSection['SECTION_PAGE_URL']?>" class="nav__item" data-bx-iblock-section-id="<?=$dctSection['ID']?>">
            <?=$dctSection['NAME']?>
            <?if($dctSection['CHILDS_ID']):?>
            <svg width="8" height="3" viewBox="0 0 8 3" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 3L0.535898 6.52533e-07L7.4641 4.68497e-08L4 3Z" fill="#C8AF86"/></svg>
            <?endif?>
        </a>
        <?if($dctSection['CHILDS_ID']):?>
        <ul class="nav__dropdown-menu">
            <?foreach($dctSection['CHILDS_ID'] as $ChildId): $dctSubSection = $arResult['ITEMS'][$arResult['MAP'][$ChildId]];?>
            <li data-bx-iblock-section-id="<?=$dctSubSection['ID']?>"><a href="<?=$dctSubSection['SECTION_PAGE_URL']?>"><?=$dctSubSection['NAME']?></a></li>
            <?endforeach?>
        </ul>
        <?endif?>
    </li>
    <?endforeach?>
</ul>