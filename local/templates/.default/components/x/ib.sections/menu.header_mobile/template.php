<ul class="mobile-menu__nav">
    <?foreach($arResult['ITEMS'] as $dctSection): if ($dctSection['IBLOCK_SECTION_ID']) continue; ?>
    <li class="mobile-menu__dropdown" data-bx-iblock-section-id="<?=$dctSection['ID']?>">
        <a href="<?=$dctSection['SECTION_PAGE_URL']?>"><?=$dctSection['NAME']?></a>
        <?if($dctSection['CHILDS_ID']):?>
        <ul class="mobile-menu__dropdown-menu js-mobile-menu-dropdown-menu">
            <?foreach($dctSection['CHILDS_ID'] as $ChildId): $dctSubSection = $arResult['ITEMS'][$arResult['MAP'][$ChildId]];?>
            <li data-bx-iblock-section-id="<?=$dctSubSection['ID']?>"><a href="<?=$dctSubSection['SECTION_PAGE_URL']?>"><?=$dctSubSection['NAME']?></a></li>
            <?endforeach?>
        </ul>
        <div class="mobile-menu__dropdown-btn js-mobile-menu-dropdown-btn">
            <span class="lnil"><svg width="3" height="8" viewBox="0 0 3 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 4L-3.26266e-07 7.4641L-2.34249e-08 0.535898L3 4Z" fill="#C8AF86"/></svg></span>
        </div>
        <?endif?>
    </li>
    <?endforeach?>
</ul>