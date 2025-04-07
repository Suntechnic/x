<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$context = new \Bxx\Context;
$context->setAliases ([
        'lang'=>'\Bxx\Context\Language', 
        'language'=>'lang',
        'site'=>'\Bxx\Context\Site'
    ]);

foreach (['lang', 'site'] as $Alias) {
    $state = $context->getState($Alias);
    ?>
    <h2><?=$state->getTitleState()?>: <?=$state->get()?></h2>
    <ul>
    <?foreach ($state->getList() as $dctItem):?>
        <li><?=$dctItem['title']?> (<?=$dctItem['name']?>)</li>
    <?endforeach;?>
    </ul>
    <?
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>