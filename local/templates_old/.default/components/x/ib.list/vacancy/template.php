<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$dctItem = $arResult['ITEMS'][0];
?>

<div class="container">
    <h1><?=$dctItem['NAME']?></h1>
    <div class="vacancy__content"><?=$dctItem['DETAIL_TEXT']?></div>
    
    <h2 class="bg-black mobile-default">Откликнуться на вакансию</h2>
    
    
    <div class="form__grid">
        
        
        <?$APPLICATION->IncludeComponent(
                'x:ib.apd',
                'vacancy',
                Array(
                        'UID' => 'vacancy_'.IDIB_VACANCIESBACKS,
                        'IBLOCK_ID' => IDIB_VACANCIESBACKS,
                        
                        'FIELDS' => ['NAME'], // коды свойств которые можно/добавлять обновлять
                        'PROPERTIES' => ['TEL','PORTFOLIO','PORTFILE','TESTRESULT','TESTRESULTFILE'], // коды свойств которые можно/добавлять обновлять
                        
                        'TEMPLATE' => [
                            'TEST_URL' => $dctItem['PROPERTY_TEST_VALUE']
                        ]
                    ),
                $component
            );?>
        
        <?include(S_P_INCLUDES.'/vacancy-next.php');?>
        
    </div>
    
</div>

