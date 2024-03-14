<div class="row mb-4">
    <div class="d-block d-lg-none col-auto order-1">
        <div class="open-filter js-open-filter">Filters</div>
    </div>
    <div class="col-lg col-12 order-3 order-lg-1 pt-3 pt-lg-0">
        <div class="count-product">
            <?=count($arResult['ITEMS'])?> products
        </div>
    </div>
    <div class="col-lg-auto col order-2">
        <div class="sortet">
            <div class="sortet__header">
                Sort by:
                <?if($arResult['SORT']['ACTIVE'] == 'Y'):?>
                <span><?=$arResult['SORT']['TITLE'];?></span>
                <?else:?>
                <span>Strange</span>
                <?endif?>
            </div>
            <div class="sortet__body">
                <div class="sortet-list">
                    <?$uri = new \Bitrix\Main\Web\Uri($arParams['TEMPLATE']['URI']);?>
                    <?foreach(\App\Catalog\Component::sortsList() as $dctSort):
                    $uri->addParams(['sort'=>$dctSort['CODE']]);
                    ?>
                    <a 
                            class="sortet-item <?if($arResult['SORT']['ACTIVE'] == 'Y' && $dctSort['CODE'] == $arResult['SORT']['CODE']):?>sortet-item--active<?endif?>"
                            href="<?=$uri->getUri()?>"
                        ><?=$dctSort['TITLE']?></a>
                    <?endforeach?>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <?foreach ($arResult['ITEMS'] as $dctItem):?>
    <div class="col-md-4 col-6 mb-4">
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