<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?include(S_P_LAYOUT.'/header.php');
$ss = \App\Stringstorage::getInstance();
?>
<div class="page">
	<!-- HEADER :: START-->
	<header class="header">
		<div class="container">
			<div class="header__wrapper"><a class="header__logotype" href="#"><img src="<?=P_IMAGES?>/logotype.svg" alt=""></a>
				<div class="header__dropdown">
					<div class="header__menu"><a href="#advantages" js-scroll>Преимущества</a><a href="#test" js-scroll>Тест</a><a href="#articles" js-scroll>Статьи</a><a href="#faq" js-scroll>Вопрос-ответ</a></div>
					<div class="header__button"><a class="btn btn--small" href="#">Наличие в аптеках</a></div>
				</div>
				<div class="header__button"><a class="btn btn--small" href="#">Наличие в аптеках</a></div>
				<button class="hamburger" js-hamburger><span class="top"></span><span class="middle"></span><span class="bottom"></span></button>
			</div>
		</div>
	</header>
	<!-- HEADER :: END-->
	<main>