<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$ss = \Bxx\Stringstorage::getInstance();
$phone = \Bitrix\Main\PhoneNumber\Parser::getInstance()->parse($ss->getStringVal('phone'));
?>
    <footer class="footer">
        <div class="container container--type-5">
            <div class="row">
                
                <div class="col-auto footer__first-column">
                    <h5 class="footer__heading">Contact us</h5>
                    <div class="footer__address">
                        <p class="">
                            Address: J Sing LLC 16192 Coastal H<br>
                            ighway Lewes, Delaware, USA 19958
                        </p>
                        
                        <p class="">Support Hotline: <?=$phone->getRawNumber();?></p>
                        <p class="">Email: 
                            <a style="text-decoration:underline;" href="mailto:<?=$ss->getStringVal('email')?>"><?=$ss->getStringVal('email')?></a>
                        </p>
                    </div>
                </div>

                <div class="col footer__second-column">
                    <h5 class="footer__heading">Product</h5>
                    <?$APPLICATION->IncludeComponent(
                            'x:ib.sections',
                            'menu.footer',
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
                </div>

                <div class="col footer__third-column">
                    <h5 class="footer__heading">Information</h5>
                    <ul class="footer__menu">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Install LED Mirror</a></li>
                        <li><a href="#">Manuals</a></li>
                        <li><a href="#">FAQs</a></li>
                    </ul>
                </div>
                <div class="col footer__third-column">
                    <h5 class="footer__heading text-nowrap">Customer Service</h5>
                    <ul class="footer__menu">
                        <li><a href="#">Terms and conditions</a></li>
                        <li><a href="#">Delivery</a></li>
                        <li><a href="#">Payments</a></li>
                        <li><a href="#">Privacy policy</a></li>
                    </ul>
                </div>
                <div class="col-auto footer__fourth-column">
                    <h5 class="footer__heading">Newsletter</h5>
                    <form class="footer__newsletter">
                        <div class="footer__newsletter-description">Subscribe to be the first to find out new releases, sales, and articles from Inyouths.</div>
                        <!-- <div class="mb-3 position-relative">
                            <input type="email" class="footer__newsleter-input" placeholder="Your e-mail">
                            <svg class="position-absolute top-50 end-0" style="margin:-7px 18px 0 0;" width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.47998 6.97998H16.47" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M10.48 0.98999L16.52 6.99999L10.48 13.01" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div> -->
                        <div class="d-flex align-items-center col-auto justify-content-start pt-1">
                            <a href="<?=$ss->getStringVal('facebook')?>" class="me16">
                                <i class="lnil"><img src="/local/assets/img/face.svg" style="width: 27px;"></i>
                            </a>
                            <a href="<?=$ss->getStringVal('instagram')?>" class="me16">
                                <i class="lnil"><img src="/local/assets/img/ins.svg" style="width:27px;"></i>
                            </a>
                            <a href="" class="<?=$ss->getStringVal('whathapp')?>">
                                <i class="lnil"><img src="/local/assets/img/wats.svg" style="width:27px;"></i>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="copyright">
                <div class="row">
                    <div class="col-lg-3 copyright__first-column">
                        © Copyright 2023 Apollo Mirror
                    </div>
                    <!--<div class="col-lg-3 copyright__second-column"></div>-->
                    <div class="col-lg-6 copyright__payment"></div>
                </div>
            </div>
        </div>
    </footer>
</div><!--.main-->
<?include(\Bitrix\Main\Application::getDocumentRoot().'/local/templates/.default/footer.php');?>