<?
$lstGallery = [];
if ($arResult['DETAIL_PICTURE']) $lstGallery[] = $arResult['DETAIL_PICTURE'];
if ($arResult['PROPERTIES']['GALLERY']) {
    foreach ($arResult['PROPERTIES']['GALLERY']['VALUE'] as $PicId) {
        $lstGallery[] = \CFile::GetFileArray($PicId);
    }
}

?>
<div class="cart-main-previewer">
    <div class="card-preview">
        <?if ($arResult['PROPERTIES']['SEO_MARK']):?>
        <div class="product-grid-item__tag-list">
            <?foreach ($arResult['PROPERTIES']['SEO_MARK']['VALUE'] as $Name): ?>
            <div class="product-grid-item__tag tag_<?=preg_replace('/[^ a-z\d]/ui', '',strtolower($Name))?>"><?=$Name?></div>
            <?endforeach?>
        </div>
        <?endif?>
        <div class="swiper-button-prev d-none d-lg-block">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <circle cx="20" cy="20" r="20" fill="#C8AF86" />
                <g clip-path="url(#clip0_99_545)">
                    <path d="M27.5195 19.98H12.5295" stroke="white" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M18.5195 13.99L12.4795 20L18.5195 26.01" stroke="white"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </g>
                <defs>
                    <clipPath id="clip0_99_545">
                        <rect width="24" height="24" fill="white"
                            transform="matrix(-1 0 0 1 32 8)" />
                    </clipPath>
                </defs>
            </svg>
        </div>
        <div class="swiper-button-next d-none d-lg-block">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <circle cx="20" cy="20" r="20" transform="matrix(-1 0 0 1 40 0)"
                    fill="#C8AF86" />
                <g clip-path="url(#clip0_99_552)">
                    <path d="M12.4805 19.98H27.4705" stroke="white" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M21.4805 13.99L27.5205 20L21.4805 26.01" stroke="white"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </g>
                <defs>
                    <clipPath id="clip0_99_552">
                        <rect width="24" height="24" fill="white"
                            transform="translate(8 8)" />
                    </clipPath>
                </defs>
            </svg>
        </div>
        <div class="product-sliders swiper">
            <div class="swiper-wrapper">
                <?foreach ($lstGallery as $dctPic):?>
                <div class="swiper-slide">
                    <img src="<?=$dctPic['SRC']?>" alt="">
                    <a href="<?=$dctPic['SRC']?>" class="zoom-img"
                        data-fancybox="gallery"></a>
                </div>
                <?endforeach?>
            </div>

        </div>
        <div class="swiper-pagination d-block d-lg-none"></div>

    </div>
</div>
<div class="d-none d-lg-block">
    <div class="product-sliders-thumbs swiper">
        <div class="swiper-wrapper">
            <?foreach ($lstGallery as $dctPic):?>
            <div class="swiper-slide">
                <img src="<?=$dctPic['SRC']?>" alt="">
            </div>
            <?endforeach?>
        </div>
    </div>
</div>