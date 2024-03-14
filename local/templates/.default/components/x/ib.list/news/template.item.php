<div class="news-item">
    <a href="" class="news-item__preview">
        <img src="<?=$dctItem['PREVIEW_PICTURE']['SRC']?>" alt="">
    </a>
    <div class="news-item__main">
        <div class="news-item__date"><?=$dctItem['X_DATE_FORMATED']?></div>
        <div class="news-item__title">
            <?=$dctItem['NAME']?>
        </div>
        <a href="<?=$dctItem['DETAIL_PAGE_URL']?>" class="news-item__more">
            <span>Read More</span>
        </a>
    </div>
</div>