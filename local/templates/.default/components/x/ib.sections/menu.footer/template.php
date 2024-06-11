<ul class="footer__menu">
    <?foreach($arResult['ITEMS'] as $dctSection): if ($dctSection['IBLOCK_SECTION_ID']) continue; ?>
    <li>
        <a href="<?=$dctSection['SECTION_PAGE_URL']?>" class="nav__item" data-bx-iblock-section-id="<?=$dctSection['ID']?>">
            <?=$dctSection['NAME']?>
        </a>
    </li>
    <?endforeach?>
</ul>