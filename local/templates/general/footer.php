<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$ss = \App\Stringstorage::getInstance();
$phone = \Bitrix\Main\PhoneNumber\Parser::getInstance()->parse($ss->getStringVal('phone'));
?>
    </main>
    <!-- FOOTER :: START-->
    <footer class="footer">
      <div class="container">
        <div class="footer__wrapper"><a class="header__logotype" href="#"><img src="img/logotype.svg" alt=""></a>
          <div class="header__menu"><a href="#">Преимущества</a><a href="#">Тест</a><a href="#">Статьи</a><a href="#">Вопрос-ответ</a></div>
          <div class="header__button"><a class="btn btn--small" href="#">Наличие в аптеках</a></div>
        </div>
      </div>
      <div class="footer__bottom">
        <div class="container">
          <div class="footer__links"><a href="#">Пользовательское соглашение</a><a href="#">Соглашение об обработке персональных данных</a><a class="phone" href="tel:<?=$phone->getRawNumber(\Bitrix\Main\PhoneNumber\Format::E164);?>"><?=$phone->getRawNumber();?></a></div>
        </div>
      </div>
    </footer>
    <!-- FOOTER :: END-->
</div>
<?include(S_P_LAYOUT.'/footer.php');?>