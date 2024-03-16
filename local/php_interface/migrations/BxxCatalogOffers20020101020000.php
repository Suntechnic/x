<?php

namespace Sprint\Migration;


class BxxCatalogOffers20020101020000 extends Version
{
    protected $description = "Инфоблок торговых предложений";

    protected $moduleVersion = "4.6.1";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $iblockId = $helper->Iblock()->saveIblock(array (
  'IBLOCK_TYPE_ID' => 'catalog',
  'LID' => 
  array (
    0 => 's1',
  ),
  'CODE' => 'offers',
  'API_CODE' => NULL,
  'REST_ON' => 'N',
  'NAME' => 'Торговые предложения',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'LIST_PAGE_URL' => '',
  'DETAIL_PAGE_URL' => '#PRODUCT_URL#',
  'SECTION_PAGE_URL' => '',
  'CANONICAL_PAGE_URL' => '',
  'PICTURE' => NULL,
  'DESCRIPTION' => '',
  'DESCRIPTION_TYPE' => 'text',
  'RSS_TTL' => '24',
  'RSS_ACTIVE' => 'Y',
  'RSS_FILE_ACTIVE' => 'N',
  'RSS_FILE_LIMIT' => NULL,
  'RSS_FILE_DAYS' => NULL,
  'RSS_YANDEX_ACTIVE' => 'N',
  'XML_ID' => NULL,
  'INDEX_ELEMENT' => 'Y',
  'INDEX_SECTION' => 'N',
  'WORKFLOW' => 'N',
  'BIZPROC' => 'N',
  'SECTION_CHOOSER' => 'L',
  'LIST_MODE' => '',
  'RIGHTS_MODE' => 'S',
  'SECTION_PROPERTY' => 'Y',
  'PROPERTY_INDEX' => 'Y',
  'VERSION' => '1',
  'LAST_CONV_ELEMENT' => '0',
  'SOCNET_GROUP_ID' => NULL,
  'EDIT_FILE_BEFORE' => '',
  'EDIT_FILE_AFTER' => '',
  'SECTIONS_NAME' => 'Разделы',
  'SECTION_NAME' => 'Раздел',
  'ELEMENTS_NAME' => 'Элементы',
  'ELEMENT_NAME' => 'Элемент',
  'EXTERNAL_ID' => NULL,
  'LANG_DIR' => '/',
  'IPROPERTY_TEMPLATES' => 
  array (
  ),
  'ELEMENT_ADD' => 'Добавить элемент',
  'ELEMENT_EDIT' => 'Изменить элемент',
  'ELEMENT_DELETE' => 'Удалить элемент',
  'SECTION_ADD' => 'Добавить раздел',
  'SECTION_EDIT' => 'Изменить раздел',
  'SECTION_DELETE' => 'Удалить раздел',
));
    $helper->Iblock()->saveGroupPermissions($iblockId, array (
  'administrators' => 'X',
  'everyone' => 'R',
));
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Элемент каталога',
  'ACTIVE' => 'Y',
  'SORT' => '500',
  'CODE' => 'CML2_LINK',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'E',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => 'CML2_LINK',
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => 'catalog:catalog',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'Y',
  'IS_REQUIRED' => 'N',
  'VERSION' => '1',
  'USER_TYPE' => 'SKU',
  'USER_TYPE_SETTINGS' => 
  array (
    'VIEW' => 'A',
    'SHOW_ADD' => 'N',
    'MAX_WIDTH' => 0,
    'MIN_HEIGHT' => 24,
    'MAX_HEIGHT' => 1000,
    'BAN_SYM' => ',;',
    'REP_SYM' => ' ',
    'OTHER_REP_SYM' => '',
    'IBLOCK_MESS' => 'N',
  ),
  'HINT' => '',
));
    
    }

    public function down()
    {
        //your code ...
    }
}
