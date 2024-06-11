<div class="swiper swiper-prods">
    <div class="swiper-wrapper">
        <?foreach ($arResult['ITEMS'] as $dctItem):?>
        <div class="swiper-slide">
            <?$APPLICATION->IncludeComponent(
                    'bitrix:catalog.item',
                    '',
                    array(
                            'RESULT' => array(
                                'ITEM' => $dctItem,
                            ),
                            'PARAMS' => [],
                        ),
                    $component,
                    array('HIDE_ICONS' => 'Y')
                );?>
        </div>
        <?endforeach?>
    </div>
    <div class="swiper-pagination"></div>
</div>