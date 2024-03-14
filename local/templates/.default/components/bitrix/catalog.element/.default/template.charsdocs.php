<div id="accordionExample">
    <div class="accordion">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseOne" aria-expanded="true"
                    aria-controls="collapseOne">
                    Details
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show"
                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?foreach($arResult['PROPERTIES'] as $PropCode=>$dctProp): if (!$dctProp['VALUE'] 
                            || substr($PropCode,0,5) != 'CHAR_') continue;?>
                    <div class="row mb-2">
                        <div class="col"><strong><?=$dctProp['NAME']?>:</strong></div>
                        <div class="col-8 text-right">
                            <?=is_array($dctProp['VALUE'])?implode(', ',$dctProp['VALUE']):$dctProp['VALUE']?>
                        </div>
                    </div>
                    <?endforeach?>
                </div>
            </div>
        </div>

    </div>

    <?if($arResult['PREVIEW_TEXT']):?>
    <div class="accordion">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                    aria-expanded="false" aria-controls="collapseTwo">
                    Documentation
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse"
                aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body"><?=$arResult['PREVIEW_TEXT']?></div>
            </div>
        </div>
    </div>
    <?endif?>


    <div class="d-block d-md-none">
        <?if($arResult['DETAIL_TEXT']):?>
        <div class="accordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading3">
                    <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapse3"
                        aria-expanded="false" aria-controls="collapse3">
                        Description
                    </button>
                </h2>
                <div id="collapse3" class="accordion-collapse collapse"
                    aria-labelledby="heading3" data-bs-parent="#accordionExample">
                    <div class="accordion-body"><?=$arResult['DETAIL_TEXT']?></div>
                </div>
            </div>
        </div>
        <?endif?>

        <?/*?>
        <div class="accordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading4">
                    <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapse4"
                        aria-expanded="false" aria-controls="collapse4">
                        Review
                    </button>
                </h2>
                <div id="collapse4" class="accordion-collapse collapse"
                    aria-labelledby="heading4" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="review-main">
                            <div class="review-stats">

                                <div class="rating-product">
                                    <div class="star star--active"></div>
                                    <div class="star star--active"></div>
                                    <div class="star star--active"></div>
                                    <div class="star star--active"></div>
                                    <div class="star star"></div>
                                    <div class="rating-product__count"><strong>4.5</strong>
                                        <span>12 reviews</span>
                                    </div>
                                </div>
                    
                                <a href="#" class="add-cart second-button">Write a
                                    Review</a>
                            </div>
                            <div class="review-list">
                                <div class="review-item">

                                    <div class="review-item__header">
                                        <div class="review-item__name">Alex Sanchez</div>

                                        <div class="review-item__date">2 monts ago</div>

                                    </div>
                                    <div class="review-item-stars">
                                        <div class="review-star"></div>
                                        <div class="review-star"></div>
                                        <div class="review-star"></div>
                                        <div class="review-star review-star--only"></div>
                                        <div class="review-star review-star--clear"></div>
                                    </div>
                                    <div class="review-item__title">Striking Contemporary
                                        Chandelier</div>
                                    <div class="review-item__desc">
                                        We got this for our living room (vaulted ceiling -
                                        large room) in the Polished Aluminum finish. It's
                                        beautiful! I love everything about it. Be warned
                                        that it comes in a HUGE box!
                                    </div>
                                    <div class="review-item__footer">
                                        <div class="row">
                                            <div class="col"><a href="#"
                                                    class="review-item__read-more">Read
                                                    More</a></div>
                                            <div class="col-auto">
                                                <div class="review-item_links">
                                                    <a href="#">Helpful</a>
                                                    <a href="#">Report</a>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="review-item">

                                    <div class="review-item__header">
                                        <div class="review-item__name">Alex Sanchez</div>

                                        <div class="review-item__date">2 monts ago</div>

                                    </div>
                                    <div class="review-item-stars">
                                        <div class="review-star"></div>
                                        <div class="review-star"></div>
                                        <div class="review-star"></div>
                                        <div class="review-star review-star--only"></div>
                                        <div class="review-star review-star--clear"></div>
                                    </div>
                                    <div class="review-item__title">Striking Contemporary
                                        Chandelier</div>
                                    <div class="review-item__desc">
                                        We got this for our living room (vaulted ceiling -
                                        large room) in the Polished Aluminum finish. It's
                                        beautiful! I love everything about it. Be warned
                                        that it comes in a HUGE box!
                                    </div>
                                    <div class="review-item__footer">
                                        <div class="row">
                                            <div class="col"><a href="#"
                                                    class="review-item__read-more">Read
                                                    More</a></div>
                                            <div class="col-auto">
                                                <div class="review-item_links">
                                                    <a href="#">Helpful</a>
                                                    <a href="#">Report</a>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="review-item">

                                    <div class="review-item__header">
                                        <div class="review-item__name">Alex Sanchez</div>

                                        <div class="review-item__date">2 monts ago</div>

                                    </div>
                                    <div class="review-item-stars">
                                        <div class="review-star"></div>
                                        <div class="review-star"></div>
                                        <div class="review-star"></div>
                                        <div class="review-star review-star--only"></div>
                                        <div class="review-star review-star--clear"></div>
                                    </div>
                                    <div class="review-item__title">Striking Contemporary
                                        Chandelier</div>
                                    <div class="review-item__desc">
                                        We got this for our living room (vaulted ceiling -
                                        large room) in the Polished Aluminum finish. It's
                                        beautiful! I love everything about it. Be warned
                                        that it comes in a HUGE box!
                                    </div>
                                    <div class="review-item__footer">
                                        <div class="row">
                                            <div class="col"><a href="#"
                                                    class="review-item__read-more">Read
                                                    More</a></div>
                                            <div class="col-auto">
                                                <div class="review-item_links">
                                                    <a href="#">Helpful</a>
                                                    <a href="#">Report</a>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?/**/?>
    </div>
</div>