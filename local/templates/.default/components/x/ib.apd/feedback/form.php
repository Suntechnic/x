<h1 class="bg-black">Заполните форму</h1>
<?
$ss = \Model\Stringstorage::getInstance();
$email = $ss->getStringVal('hello_mail');
$phone = $ss->getStringVal('phone');
?>
<p class="sub-title">или расскажите о своей задаче <br>по телефону <a href="tel:<?=\X\Helpers\Html::phoneNormal($phone)?>"><?=\X\Helpers\Html::phone($phone)?></a></p>
<div class="form__grid">
    <div class="form__content">
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="form__content-item">
                <h3>Услуги</h3>
                <?$APPLICATION->IncludeComponent(
                        'x:ib.list',
                        'services-inputs',
                        Array(
                                'ELEMENTS_COUNT' => 1000,
                                'SORT' => ['SORT'=>'ASC', 'NAME'=>'ASC'],
                                'FILTER' => [
                                        'IBLOCK_ID' => IDIB_SERVICES,
                                        'ACTIVE' => 'Y',
                                    ],
                                'SELECT' => [
                                        'NAME',
                                        'ID'
                                    ],
                                    
                                'KEYS_CACHED' => ['ITEMS'],
                                
                                'CACHE_TYPE' => APPLICATION_ENV=='dev'?'N':'A',
                                'CACHE_TIME' => 3600,
                                'CACHE_FILTER' => 'Y',
                                'CACHE_GROUPS' => 'Y',
                                
                                'TEMPLATE' => [
                                    'NAME' => 'PROPERTY_VALUES[SERVICES][]'
                                ]
                            )
                    );?>
                
            </div>
            <?/*
            <div class="form__content-item">
                <h3>Бюджет</h3>
                <div class="inputs-grid">
                    <div class="inputs-grid__el inputs-grid__el--w20">
                        <label class="input-check">
                            <input type="radio" name="PROPERTY_VALUES[BUDGET]" value="до 0,5 млн."><span>до 0,5 млн.</span>
                        </label>
                    </div>
                    <div class="inputs-grid__el inputs-grid__el--w20">
                        <label class="input-check">
                            <input type="radio" name="PROPERTY_VALUES[BUDGET]" value="0,5 - 2 млн."><span>0,5 - 2 млн.</span>
                        </label>
                    </div>
                    <div class="inputs-grid__el inputs-grid__el--w20">
                        <label class="input-check">
                            <input type="radio" name="PROPERTY_VALUES[BUDGET]" value="2 - 5 млн."><span>2 - 5 млн.</span>
                        </label>
                    </div>
                    <div class="inputs-grid__el inputs-grid__el--w20">
                        <label class="input-check">
                            <input type="radio" name="PROPERTY_VALUES[BUDGET]" value="5 - 10 млн."><span>5 - 10 млн.</span>
                        </label>
                    </div>
                    <div class="inputs-grid__el inputs-grid__el--w20">
                        <label class="input-check">
                            <input type="radio" name="PROPERTY_VALUES[BUDGET]" value="10+ млн."><span>10+ млн.</span>
                        </label>
                    </div>
                </div>
            </div>
            */?>
            
            <div class="form__content-item">
                <h3>Задача</h3>
                
                <div class="input-container">
                    <input
                            type="text"
                            name="FIELD_VALUES[PREVIEW_TEXT]"
                            placeholder="Описание"
                            value=""
                            groupe="desc"
                        ><span class="label">Описание</span>
                </div>
                
                <div class="file-load">
                    <div class="remove"><img src="<?=P_IMAGES?>/close.svg" alt=""></div>
                    <input
                            type="file"
                            id="<?=\X\Helpers\Html::newID('fileinput');?>"
                            name="file"
                            groupe="desc"
                        >
                    <label for="<?=\X\Helpers\Html::lastID();?>">
                        <p>+ Добавить файл</p><span></span>
                    </label>
                </div>
                
            </div>
            
            <div class="form__content-item">
                <h3>Контакты</h3>
                <div class="inputs-grid">
                    <div class="inputs-grid__el">
                        <div class="input-container">
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
                        <div class="input-container">
                            <input
                                    type="email"
                                    name="PROPERTY_VALUES[EMAIL]"
                                    placeholder="Эл. почта"
                                    value=""
                                    required
                                ><span class="label">Эл. почта</span>
                        </div>
                    </div>
                    <div class="inputs-grid__el">
                        <div class="input-container">
                            <input
                                    type="tel"
                                    name="PROPERTY_VALUES[PHONE]"
                                    placeholder="Телефон"
                                    value=""
                                    required
                                ><span class="label">Телефон</span>
                        </div>
                    </div>
                    <div class="inputs-grid__el">
                        <div class="input-container">
                            <input
                                    type="text"
                                    name="PROPERTY_VALUES[SITE]"
                                    placeholder="Сайт или название компании"
                                    value=""
                                ><span class="label">Сайт или название компании</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="form__content-item">
                <button class="btn"> <span>Отправить</span></button>
                <p class="legacy">Нажимая кнопку Отправить, вы соглашаетесь с <a href="/privacy/">политикой обработки персональных данных.</a></p>
            </div>
        </form>
    </div>
    <div class="form__info">
        <div class="form__info-item">
          <h4>Что дальше?</h4>
          <p>После заполнения формы мы свяжемся с вами для уточнения деталей, либо договоримся о дате и времени обсуждения проекта очно или в Skype / Zoom.</p>
        </div>
        <div class="form__info-item">
          <h4>Подготовка КП</h4>
          <p>Занимает 1-2 рабочих дня для стандартных проектов или услуг. В остальных случаях мы можем дать ценовой ориентир и подготовить точную смету после проектирования решения или предпроектного исследования.</p>
        </div>
        <div class="form__info-item">
            <h4>Pre-sale</h4>
            <p>Переговоры ведут проектные менеджеры и генеральный директор, чтобы уже на этапе переговоров можно было обсудить конкретные предложения по решению ваших задач от команды, которая в дальнейшем будет заниматься реализацией. Продает тот, кто будет делать, менеджеров по продажам у нас нет.</p>
        </div>
        <div class="form__info-item">
            <h4>Концепция</h4>
            <p>Мы готовы предоставить концепцию проекта как на платной, так и на бесплатной основе. Для интересных нам проектов мы готовы сделать бесплатную концепцию после предварительного знакомства и обсуждения.</p>
        </div>
    </div>
</div>