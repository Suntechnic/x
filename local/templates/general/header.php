<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?include(\Bitrix\Main\Application::getDocumentRoot().'/local/templates/.default/header.php');
$ss = \Bxx\Stringstorage::getInstance();
$phone = \Bitrix\Main\PhoneNumber\Parser::getInstance()->parse($ss->getStringVal('phone'));
$router = \Bitrix\Main\Application::getInstance()->getRouter();

\Bitrix\Main\UI\Extension::load(['app.vue.components.favorites.link','app.vue.components.basket.link']);

$APPLICATION->ShowPanel();
?>
<div id="main">
    <header class="header header--type-7">

        <div class="header__promo-bar d-none d-md-block">
            <div class="container container--type-5">
                <div class="row">
                    <div class="d-flex align-items-center col text-start">
                        <a href="tel:<?=$phone->getRawNumber(\Bitrix\Main\PhoneNumber\Format::E164);?>" class="me-5">
                            <i class="lnil"><img src="/local/assets/img/phone.svg"></i>
                            <span><?=$phone->getRawNumber();?></span>
                        </a>
                        <a href="mailto:<?=$ss->getStringVal('email')?>" >
                            <i class="lnil"><img src="/local/assets/img/mail.svg"></i>
                            <span><?=$ss->getStringVal('email')?></span>
                        </a>
                    </div>
                    <div class="d-flex align-items-center col-auto justify-content-end">
                        <a href="<?=$ss->getStringVal('facebook')?>" class="me-3">
                            <i class="lnil"><img src="/local/assets/img/face.svg"></i>
                        </a>
                        <a href="<?=$ss->getStringVal('instagram')?>" class="me-3">
                            <i class="lnil"><img src="/local/assets/img/ins.svg"></i>
                        </a>
                        <a href="<?=$ss->getStringVal('whathapp')?>" class="">
                            <i class="lnil"><img src="/local/assets/img/wats.svg"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container container--type-5">
            <div class="header__container d-flex align-items-center">
                <div class="header__mobile-menu">
                    <div class="mobile-menu__open">
                        <a href="#" class="js-open-mobile-menu">
                            <i class="lnil d-flex"><img src="/local/assets/img/m.svg"></i>
                        </a>
                    </div>
                    <div class="mobile-menu js-mobile-menu">
                        <div class="mobile-menu__overlay js-close-mobile-menu"></div>
                        <div class="mobile-menu__content">
                            <div class="mobile-menu__close">
                                <a href="#" class="js-close-mobile-menu"><i class="lnil lnil-close"></i></a>
                            </div>
                            <div class="mobile-menu__user">
                                <div class="d-flex justify-content-center text-nowrap">
                                    <a href="<?=$router->route('personal');?>" class="d-flex justify-content-center align-items-center mx-4">
                                        <i class="lnil me-2"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 19C14.9706 19 19 14.9706 19 10C19 5.02944 14.9706 1 10 1C5.02944 1 1 5.02944 1 10C1 14.9706 5.02944 19 10 19Z" stroke="#C8AF86" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M9.99994 11.12C11.5519 11.12 12.8099 9.86192 12.8099 8.31C12.8099 6.75808 11.5519 5.5 9.99994 5.5C8.44802 5.5 7.18994 6.75808 7.18994 8.31C7.18994 9.86192 8.44802 11.12 9.99994 11.12Z" stroke="#C8AF86" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M15.71 16.96C14.28 15.45 12.25 14.5 10 14.5C7.75004 14.5 5.73004 15.45 4.29004 16.96" stroke="#C8AF86" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        </i>
                                        Auth / Registration
                                    </a>
                                    <a href="<?=$router->route('personal/favorites');?>" class="d-flex justify-content-center align-items-center px-4" style="border-left: 1px solid #f1f1f1;">
                                        <i class="lnil me-2"><svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.51 0.800049C16.64 0.800049 18.73 3.78005 18.73 6.56005C18.73 12.19 10.02 16.8 9.87 16.8C9.72 16.8 1 12.19 1 6.56005C1 3.78005 3.1 0.800049 6.22 0.800049C8.01 0.800049 9.18 1.71005 9.86 2.51005C10.54 1.70005 11.71 0.800049 13.5 0.800049H13.51Z" stroke="#C8AF86" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        </i>
                                        Favorites
                                    </a>
                                </div>
                            </div>
                            <?$APPLICATION->IncludeComponent(
                                    'x:ib.sections',
                                    'menu.header_mobile',
                                    Array(
                                            'FILTER' => [
                                                    'IBLOCK_ID' => \Bxx\Helpers\IBlocks::getIdByCode('catalog'),
                                                ],
                                            'SELECT' => [
                                                    'NAME',
                                                    'CODE',
                                                    'SECTION_PAGE_URL',
                                                    'IBLOCK_SECTION_ID'
                                                ],
                                            
                                            'CACHE_TYPE' => APPLICATION_ENV=='dev'?'N':'A',
                                            'CACHE_TIME' => 36000,
                                            'CACHE_FILTER' => 'Y',
                                            'CACHE_GROUPS' => 'Y',
                                        )
                                );?>
                            <div class="col footer__fourth-column m16">
                                <h5 class="footer__heading">Newsletter</h5>
                                <form class="footer__newsletter">
                                    <div class="footer__newsletter-description">Subscribe to be the first to find out new releases, sales, and articles from Inyouths.</div>
                                    <!-- <div class="mb-3 position-relative">
                                        <input type="email" class="footer__newsleter-input" placeholder="Your e-mail">
                                        <svg class="position-absolute top-50 end-0" style="margin:-7px 18px 0 0;" width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.47998 6.97998H16.47" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M10.48 0.98999L16.52 6.99999L10.48 13.01" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                    </div> -->

                                    <div class="d-flex align-items-center col-auto justify-content-start">
                                        <a href="<?=$ss->getStringVal('facebook')?>" class="me-3">
                                            <i class="lnil"><img src="/local/assets/img/face.svg" style="width:24px;"></i>
                                        </a>
                                        <a href="<?=$ss->getStringVal('instagram')?>" class="me-3">
                                            <i class="lnil"><img src="/local/assets/img/ins.svg" style="width:24px;"></i>
                                        </a>
                                        <a href="<?=$ss->getStringVal('whathapp')?>" class="">
                                            <i class="lnil"><img src="/local/assets/img/wats.svg" style="width:24px;"></i>
                                        </a>
                                    </div>

                                </form>
                            </div>
                            <div class="d-flex justify-content-between m16 pt-3">
                                <a href="tel:<?=$phone->getRawNumber(\Bitrix\Main\PhoneNumber\Format::E164);?>" class="d-flex justify-content-center align-items-center text-nowrap me-3">
                                    <i class="lnil me-2">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_179_3508)">
                                        <path d="M12.6398 11.0733L11.8598 10.2933C11.4665 9.89992 10.8331 9.89992 10.4465 10.2933L9.83313 10.9066C9.69313 11.0466 9.48646 11.0866 9.31313 11.0133C8.4198 10.6199 7.5398 10.0333 6.7598 9.24659C5.9798 8.46659 5.38646 7.58659 4.9998 6.69992C4.9198 6.51326 4.96646 6.29992 5.10646 6.15992L5.6598 5.60659C6.10646 5.15992 6.10646 4.52659 5.71313 4.13326L4.93313 3.35326C4.41313 2.83326 3.56646 2.83326 3.04646 3.35326L2.61313 3.78659C2.1198 4.27992 1.91313 4.99326 2.04646 5.69992C2.37313 7.43992 3.38646 9.34659 5.0198 10.9799C6.65313 12.6133 8.5598 13.6266 10.2998 13.9533C11.0065 14.0866 11.7198 13.8799 12.2131 13.3866L12.6465 12.9533C13.1665 12.4333 13.1665 11.5866 12.6465 11.0666L12.6398 11.0733Z" stroke="#C8AF86" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M8.6665 4.66004C9.35317 4.65337 10.0465 4.90671 10.5665 5.42671" stroke="#C8AF86" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M12.4532 3.54665C11.4065 2.49998 10.0332 1.97998 8.6665 1.97998" stroke="#C8AF86" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M11.3399 7.33335C11.3466 6.64668 11.0932 5.95335 10.5732 5.43335" stroke="#C8AF86" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M12.4531 3.54663C13.4998 4.5933 14.0198 5.96663 14.0198 7.3333" stroke="#C8AF86" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0_179_3508">
                                        <rect width="16" height="16" fill="white"></rect>
                                        </clipPath>
                                        </defs>
                                        </svg>
                                    </i>
                                    <?=$phone->getRawNumber();?>
                                </a>
                                <a href="mailto:<?=$ss->getStringVal('email')?>" class="d-flex justify-content-center text-nowrap  align-items-center">
                                    <i class="lnil me-2">
                                    <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.3335 1.33337H2.66683C1.93045 1.33337 1.3335 1.93033 1.3335 2.66671V9.33337C1.3335 10.0698 1.93045 10.6667 2.66683 10.6667H13.3335C14.0699 10.6667 14.6668 10.0698 14.6668 9.33337V2.66671C14.6668 1.93033 14.0699 1.33337 13.3335 1.33337Z" stroke="#C8AF86" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M14.6536 2.66675L9.32691 6.84008C8.60691 7.40008 7.60024 7.40675 6.88024 6.85341L1.41357 2.66675" stroke="#C8AF86" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M10.2866 6.08667L14.2866 9.67334" stroke="#C8AF86" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M5.77344 6.00671L1.77344 9.66671" stroke="#C8AF86" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                    </i>
                                    mailto:<?=$ss->getStringVal('email')?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <h1 class="header__logo"><a href="/"><img src="/local/assets/img/logo.svg" /></a></h1>
                <?$APPLICATION->IncludeComponent(
                        'x:ib.sections',
                        'menu.header',
                        Array(
                                'FILTER' => [
                                        'IBLOCK_ID' => \Bxx\Helpers\IBlocks::getIdByCode('catalog'),
                                    ],
                                'SELECT' => [
                                        'NAME',
                                        'CODE',
                                        'SECTION_PAGE_URL',
                                        'IBLOCK_SECTION_ID'
                                    ],
                                
                                'CACHE_TYPE' => APPLICATION_ENV=='dev'?'N':'A',
                                'CACHE_TIME' => 36000,
                                'CACHE_FILTER' => 'Y',
                                'CACHE_GROUPS' => 'Y',
                            )
                    );?>
                <ul class="header__right">
                    <li>
                        <a href="#" class="js-open-popup-search"><i class="lnil"><img src="/local/assets/img/search.svg" /></i></a>
                    </li>
                    <li class="header__cart d-none d-lg-block" vue="FavoriteLink" data-href="<?=$router->route('personal/favorites');?>">
                    </li>
                    <li class="header__cart me-2 me-sm-0" vue="BasketLink" data-href="<?=$router->route('cart');?>">
                        
                    </li>
                    <li class="d-none d-lg-block">
                        <a href="<?=$router->route('personal');?>"><i class="lnil"><img src="/local/assets/img/login.svg" /></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </header>



    <div class="js-search-popup search-popup">
        <div class="search-popup__header">
            <div class="container">
                <div class="search-form">
                    <button class="search-form__btn" type="submit">
                        <img src="/local/assets/img/search.svg" alt="">
                    </button>
                    <input type="text" class="search-form__input" value="LED Mirrors">
                    <button class="search-form__close js-close-search-popup" type="button">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_141_4665)">
                                <path d="M14.3238 1.67598L1.67578 14.324"  stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M14.3238 14.324L1.67578 1.67598"  stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_141_4665">
                                    <rect width="16" height="16" fill="white"/>
                                </clipPath>
                            </defs>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div class="search-popup__body">
            <div class="container">
                <div class="search-result">
                    <div class="search-result__title">Category</div>
                    <ul class="result-list">
                        <li class="result-list__item">
                            <a href="#" class="result-list__link">LED Mirrors</a>
                        </li>
                        <li class="result-list__item">
                            <a href="#" class="result-list__link">Mirror</a>
                        </li>
                        <li class="result-list__item">
                            <a href="#" class="result-list__link">Framed Mirrors</a>
                        </li>
                        <li class="result-list__item">
                            <a href="#" class="result-list__link">Decorative Mirrors</a>
                        </li>
                    </ul>
                </div>
                <div class="products-search">
                    <div class="row align-items-end mb-4">
                        <div class="col-lg-3">
                            <h3 class="mirror-item__title mb-0">Led Mirros</h3>
                        </div>
                        <div class="col-lg">
                            <span>47 products</span>
                        </div>
                        <div class="col-lg-auto">
                            <a href="" class="view-all">View all</a>
                        </div>
                    </div>
                    <div class="slider-search">
                        <div class="swiper sliderSearch">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="product-grid-item product-grid-item--type-2">
                                        <div class="product-grid-item__images product-grid-item__images--ratio-100-122 js-product-grid-images" data-current-image="0">
                                            <div class="product-grid-item__rating tag_rating"><i class="lnil lnil-star-fill active"></i><i class="lnil lnil-star-fill active"></i><i class="lnil lnil-star-fill active"></i><i class="lnil lnil-star-fill active"></i><i class="lnil lnil-star-fill"></i></div>
                                            <div class="product-grid-item__image js-product-grid-image active">
                                                <a href="product.html" tabindex="0">
                                                    <img alt="Image" src="/local/assets/img/g/1.png">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-grid-item__action">
                                            <div class="d-flex align-items-center">
                                                <div class="product-grid-item__wishlist">
                                                    <a href="#" class="open-tooltip" tabindex="0"><span class="custom-tooltip">Add to wishlist</span><i class="lnil lnil-heart"></i></a>
                                                </div>
                                                <div class="product-grid-item__compare">
                                                    <a href="#" class="open-tooltip" tabindex="0"><span class="custom-tooltip">Add to cart</span><i class="lnil lnil-cart-alt"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-grid-item__feature">Round</div>
                                        <div class="product-grid-item__name">
                                            <a href="product.html" tabindex="0">ABS Frameless Bathroom Mirror </a>
                                        </div>
                                        <div class="product-grid-item__price">
                                            <span class="product-grid-item__price-new">From $723.00</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="product-grid-item product-grid-item--type-2">
                                        <div class="product-grid-item__images product-grid-item__images--ratio-100-122 js-product-grid-images" data-current-image="0">
                                            <div class="product-grid-item__rating tag_rating"><i class="lnil lnil-star-fill active"></i><i class="lnil lnil-star-fill active"></i><i class="lnil lnil-star-fill active"></i><i class="lnil lnil-star-fill active"></i><i class="lnil lnil-star-fill"></i></div>
                                            <div class="product-grid-item__image js-product-grid-image active">
                                                <a href="product.html" tabindex="0">
                                                    <img alt="Image" src="/local/assets/img/g/1.png">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-grid-item__action">
                                            <div class="d-flex align-items-center">
                                                <div class="product-grid-item__wishlist">
                                                    <a href="#" class="open-tooltip" tabindex="0"><span class="custom-tooltip">Add to wishlist</span><i class="lnil lnil-heart"></i></a>
                                                </div>
                                                <div class="product-grid-item__compare">
                                                    <a href="#" class="open-tooltip" tabindex="0"><span class="custom-tooltip">Add to cart</span><i class="lnil lnil-cart-alt"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-grid-item__feature">Round</div>
                                        <div class="product-grid-item__name">
                                            <a href="product.html" tabindex="0">ABS Frameless Bathroom Mirror </a>
                                        </div>
                                        <div class="product-grid-item__price">
                                            <span class="product-grid-item__price-new">From $723.00</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="product-grid-item product-grid-item--type-2">
                                        <div class="product-grid-item__images product-grid-item__images--ratio-100-122 js-product-grid-images" data-current-image="0">
                                            <div class="product-grid-item__rating tag_rating"><i class="lnil lnil-star-fill active"></i><i class="lnil lnil-star-fill active"></i><i class="lnil lnil-star-fill active"></i><i class="lnil lnil-star-fill active"></i><i class="lnil lnil-star-fill"></i></div>
                                            <div class="product-grid-item__image js-product-grid-image active">
                                                <a href="product.html" tabindex="0">
                                                    <img alt="Image" src="/local/assets/img/g/1.png">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-grid-item__action">
                                            <div class="d-flex align-items-center">
                                                <div class="product-grid-item__wishlist">
                                                    <a href="#" class="open-tooltip" tabindex="0"><span class="custom-tooltip">Add to wishlist</span><i class="lnil lnil-heart"></i></a>
                                                </div>
                                                <div class="product-grid-item__compare">
                                                    <a href="#" class="open-tooltip" tabindex="0"><span class="custom-tooltip">Add to cart</span><i class="lnil lnil-cart-alt"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-grid-item__feature">Round</div>
                                        <div class="product-grid-item__name">
                                            <a href="product.html" tabindex="0">ABS Frameless Bathroom Mirror </a>
                                        </div>
                                        <div class="product-grid-item__price">
                                            <span class="product-grid-item__price-new">From $723.00</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="product-grid-item product-grid-item--type-2">
                                        <div class="product-grid-item__images product-grid-item__images--ratio-100-122 js-product-grid-images" data-current-image="0">
                                            <div class="product-grid-item__rating tag_rating"><i class="lnil lnil-star-fill active"></i><i class="lnil lnil-star-fill active"></i><i class="lnil lnil-star-fill active"></i><i class="lnil lnil-star-fill active"></i><i class="lnil lnil-star-fill"></i></div>
                                            <div class="product-grid-item__image js-product-grid-image active">
                                                <a href="product.html" tabindex="0">
                                                    <img alt="Image" src="/local/assets/img/g/1.png">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-grid-item__action">
                                            <div class="d-flex align-items-center">
                                                <div class="product-grid-item__wishlist">
                                                    <a href="#" class="open-tooltip" tabindex="0"><span class="custom-tooltip">Add to wishlist</span><i class="lnil lnil-heart"></i></a>
                                                </div>
                                                <div class="product-grid-item__compare">
                                                    <a href="#" class="open-tooltip" tabindex="0"><span class="custom-tooltip">Add to cart</span><i class="lnil lnil-cart-alt"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-grid-item__feature">Round</div>
                                        <div class="product-grid-item__name">
                                            <a href="product.html" tabindex="0">ABS Frameless Bathroom Mirror </a>
                                        </div>
                                        <div class="product-grid-item__price">
                                            <span class="product-grid-item__price-new">From $723.00</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="product-grid-item product-grid-item--type-2">
                                        <div class="product-grid-item__images product-grid-item__images--ratio-100-122 js-product-grid-images" data-current-image="0">
                                            <div class="product-grid-item__rating tag_rating"><i class="lnil lnil-star-fill active"></i><i class="lnil lnil-star-fill active"></i><i class="lnil lnil-star-fill active"></i><i class="lnil lnil-star-fill active"></i><i class="lnil lnil-star-fill"></i></div>
                                            <div class="product-grid-item__image js-product-grid-image active">
                                                <a href="product.html" tabindex="0">
                                                    <img alt="Image" src="/local/assets/img/g/1.png">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-grid-item__action">
                                            <div class="d-flex align-items-center">
                                                <div class="product-grid-item__wishlist">
                                                    <a href="#" class="open-tooltip" tabindex="0"><span class="custom-tooltip">Add to wishlist</span><i class="lnil lnil-heart"></i></a>
                                                </div>
                                                <div class="product-grid-item__compare">
                                                    <a href="#" class="open-tooltip" tabindex="0"><span class="custom-tooltip">Add to cart</span><i class="lnil lnil-cart-alt"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-grid-item__feature">Round</div>
                                        <div class="product-grid-item__name">
                                            <a href="product.html" tabindex="0">ABS Frameless Bathroom Mirror </a>
                                        </div>
                                        <div class="product-grid-item__price">
                                            <span class="product-grid-item__price-new">From $723.00</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="product-grid-item product-grid-item--type-2">
                                        <div class="product-grid-item__images product-grid-item__images--ratio-100-122 js-product-grid-images" data-current-image="0">
                                            <div class="product-grid-item__rating tag_rating"><i class="lnil lnil-star-fill active"></i><i class="lnil lnil-star-fill active"></i><i class="lnil lnil-star-fill active"></i><i class="lnil lnil-star-fill active"></i><i class="lnil lnil-star-fill"></i></div>
                                            <div class="product-grid-item__image js-product-grid-image active">
                                                <a href="product.html" tabindex="0">
                                                    <img alt="Image" src="/local/assets/img/g/1.png">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-grid-item__action">
                                            <div class="d-flex align-items-center">
                                                <div class="product-grid-item__wishlist">
                                                    <a href="#" class="open-tooltip" tabindex="0"><span class="custom-tooltip">Add to wishlist</span><i class="lnil lnil-heart"></i></a>
                                                </div>
                                                <div class="product-grid-item__compare">
                                                    <a href="#" class="open-tooltip" tabindex="0"><span class="custom-tooltip">Add to cart</span><i class="lnil lnil-cart-alt"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-grid-item__feature">Round</div>
                                        <div class="product-grid-item__name">
                                            <a href="product.html" tabindex="0">ABS Frameless Bathroom Mirror </a>
                                        </div>
                                        <div class="product-grid-item__price">
                                            <span class="product-grid-item__price-new">From $723.00</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="product-grid-item product-grid-item--type-2">
                                        <div class="product-grid-item__images product-grid-item__images--ratio-100-122 js-product-grid-images" data-current-image="0">
                                            <div class="product-grid-item__rating tag_rating"><i class="lnil lnil-star-fill active"></i><i class="lnil lnil-star-fill active"></i><i class="lnil lnil-star-fill active"></i><i class="lnil lnil-star-fill active"></i><i class="lnil lnil-star-fill"></i></div>
                                            <div class="product-grid-item__image js-product-grid-image active">
                                                <a href="product.html" tabindex="0">
                                                    <img alt="Image" src="/local/assets/img/g/1.png">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-grid-item__action">
                                            <div class="d-flex align-items-center">
                                                <div class="product-grid-item__wishlist">
                                                    <a href="#" class="open-tooltip" tabindex="0"><span class="custom-tooltip">Add to wishlist</span><i class="lnil lnil-heart"></i></a>
                                                </div>
                                                <div class="product-grid-item__compare">
                                                    <a href="#" class="open-tooltip" tabindex="0"><span class="custom-tooltip">Add to cart</span><i class="lnil lnil-cart-alt"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-grid-item__feature">Round</div>
                                        <div class="product-grid-item__name">
                                            <a href="product.html" tabindex="0">ABS Frameless Bathroom Mirror </a>
                                        </div>
                                        <div class="product-grid-item__price">
                                            <span class="product-grid-item__price-new">From $723.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-pagination">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>