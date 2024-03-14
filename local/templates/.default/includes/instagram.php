<div class="apollomirror-social mt-5 pt-4">
    <div class="container container--type-5">
        <div class="mirror-item dblock d-md-none mb-2">
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

        <?$APPLICATION->IncludeComponent(
                'x:ib.list',
                'instaswiper',
                Array(
                        'AJAX_MODE' => 'N',
                        'ELEMENTS_COUNT' => 7,
                        'SORT' => ['DATE_ACTIVE_FROM'=>'DESC', 'ID'=>'DESC'],

                        'FILTER' => [
                                'IBLOCK_ID' => \Bxx\Helpers\IBlocks::getIdByCode('instagram'),
                                'ACTIVE' => 'Y',
                                'ACTIVE_DATE' => 'Y'
                            ],
                        'SELECT' => [
                                'NAME','PREVIEW_PICTURE',
                            ],
                            
                        'CACHE_TYPE' => APPLICATION_ENV=='dev'?'N':'A',
                        'CACHE_TIME' => 3600,
                        'CACHE_FILTER' => 'Y',
                        'CACHE_GROUPS' => 'Y',
                    )
            );?>
    </div>
</div>