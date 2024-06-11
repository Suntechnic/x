<div class="row">
    <?foreach ($arResult['ITEMS'] as $dctItem):?>
    <div class="col-md-3 col-6 mb-4">
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