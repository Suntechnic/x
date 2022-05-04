<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="container">
    <h2 class="bg-black">Открытые вакансии</h2>
    <div class="form__grid">
        <div class="form__content">
            <?foreach($arResult['ITEMS'] as $dctItem):?>
            <div class="toggle-item">
                <h3 class="toggle-item__title" onclick="$(this).toggleClass('is-active').closest('.toggle-item').find('.toggle-item__hidden').slideToggle();"><?=$dctItem['NAME']?><span> </span></h3>
                <div class="toggle-item__hidden">
                    <div class="toggle-item__content">
                        <?if($dctItem['PROPERTY_PRICE_VALUE']):?><p><span><?=$dctItem['PROPERTY_PRICE_VALUE']?></span></p><?endif?>
                        <?if($dctItem['PREVIEW_TEXT']):?><p><?=$dctItem['PREVIEW_TEXT']?></p><?endif?>
                        <?if($dctItem['DETAIL_TEXT'] && $dctItem['CODE']):?><a class="arrow" href="<?=$dctItem['DETAIL_PAGE_URL']?>">Подробнее<span> </span></a><?endif?>
                    </div>
                </div>
            </div>
            <?endforeach?>
        </div>
        
        
        <div class="form__info form__info--editable">
            <div class="form__info-item">
              <h4>Базовые условия</h4>
              <div class="form__info-row">
                <div class="form__info-icon"><img src="<?=P_IMAGES?>/calendar.svg" alt=""></div>
                <p>5 дней в неделю, с понедельника по пятницу.<br>На выходных и праздниках мы отдыхаем</p>
              </div>
              <div class="form__info-row">
                <div class="form__info-icon"><img src="<?=P_IMAGES?>/time.svg" alt=""></div>
                <p>Большинство сотрудников работает с 10 до 19 Мск, возможен индивидуальный график</p>
              </div>
              <div class="form__info-row">
                <div class="form__info-icon"><img src="<?=P_IMAGES?>/place.svg" alt=""></div>
                <p>На любой позиции можно работать удалённо</p>
              </div>
            </div>
            <div class="form__info-item">
              <h4>Возможности</h4>
              <p>Мы — кузница кадров. За год работы наши сотрудники получают набор навыков, сравнимый с 2-3 годами работы у клиента.</p>
            </div>
            <div class="form__info-item">
              <h4>Задачи</h4>
              <p>В нашей работе мало рутины и много интересных задач, требующих разработки новых нестандартных решений.</p>
            </div>
            <div class="form__info-item">
              <h4>Развитие</h4>
              <p>Мы предоставляем время для саморазвития и не-клиентских задача, а также оплачиваем до 50% стоимости обучения.</p>
            </div>
        </div>
    </div>
</div>

