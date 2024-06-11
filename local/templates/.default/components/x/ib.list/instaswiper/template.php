<div class="social-slider swiper">
    <div class="swiper-wrapper">
        <div class="swiper-slide d-none d-lg-block">
            <div class="mirror-item">
                <div class="mirror-item__title">
                    #apollomirror
                </div>
                <div class="mirror-item__inst">
                    Mirror installed? Add a photo with the hashtag #apollomirror to be among 
                </div>	
                <div class="mirror-item__link">
                    Follow instagram 
                    <a href="https://instagram.com/apollomirror" target="_blank">@apollomirror</a>
                </div>
            </div>
        </div>

        <?foreach($arResult['ITEMS'] as $i=>$dctItem):?>
        <div class="swiper-slide">
            <img src="<?=$dctItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$dctItem['NAME']?>">
        </div>
        <?endforeach?>
    </div>
    <div class="swiper-pagination"></div>
</div>