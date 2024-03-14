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
<div class="form__content">
    <form action="/vacancies/form-receiver.php" method="post"  enctype="multipart/form-data">
        <?if($arParams['TEMPLATE']['TEST_URL']):?>
        <p>Для отклика на данную вакансию необходимо выполнить <a href="<?=$arParams['TEMPLATE']['TEST_URL']?>" target="_blank"> тестовое задание</a></p>
        <?endif?>
        <div class="form__content-item">
            <div class="inputs-grid inputs-grid--column">
                <div class="inputs-grid__el">
                    <div class="input-container input-container--required">
                        <input
                                type="text"
                                name="FIELD_VALUES[NAME]"
                                placeholder="Имя"
                                value=""
                                required
                            ><span class="label">Имя</span>
                    </div>
                </div>
                <div class="inputs-grid__el">
                    <div class="input-container input-container--required">
                        <input
                                type="text"
                                name="PROPERTY_VALUES[TEL]"
                                placeholder="Телефон или Telegram"
                                value=""
                                required
                            ><span class="label">Телефон или Telegram</span>
                    </div>
                </div>
                <div class="inputs-grid__el">
                    <div class="input-container input-container--required">
                        <input
                                type="text"
                                name="PROPERTY_VALUES[PORTFOLIO]"
                                placeholder="Ссылка на резюме / портфолио / сайт"
                                value=""
                            ><span class="label">Ссылка на резюме / портфолио / сайт</span>
                    </div>
                    <div class="file-load">
                        <div class="remove"><img src="<?=P_IMAGES?>/close.svg" alt=""></div>
                        <input type="file" id="<?=\X\Helpers\Html::newID('portfile');?>" name="PORTFILE">
                        <label for="<?=\X\Helpers\Html::lastID();?>">
                            <p>+ Добавить файл</p><span></span>
                        </label>
                    </div>
                </div>
                <?if($arParams['TEMPLATE']['TEST_URL']):?>
                <div class="inputs-grid__el">
                    <div class="input-container input-container--required">
                        <input
                                type="text"
                                name="PROPERTY_VALUES[TESTRESULT]"
                                placeholder="Ссылка на файл с тестовым заданием"
                                value=""
                            ><span class="label">Ссылка на файл с тестовым заданием</span>
                    </div>
                    <div class="file-load">
                        <div class="remove"><img src="<?=P_IMAGES?>/close.svg" alt=""></div>
                        <input type="file" id="<?=\X\Helpers\Html::newID('testfile');?>" name="TESTRESULTFILE">
                        <label for="<?=\X\Helpers\Html::lastID();?>">
                            <p>+ Добавить файл</p><span></span>
                        </label>
                    </div>
                </div>
                <?endif?>
            </div>
        </div>
        <div class="form__content-item">
            <button class="btn"> <span>Отправить</span></button>
            <p class="legacy">Нажимая кнопку Отправить, вы соглашаетесь с <a href="/privacy/">политикой обработки персональных данных.</a></p>
        </div>
    </form>
</div>
