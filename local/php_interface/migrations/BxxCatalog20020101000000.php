<?php

namespace Sprint\Migration;


class BxxCatalog20020101000000 extends Version
{
    protected $description = "Тип ИБ Каталог";

    protected $moduleVersion = "4.1.3";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $helper->Iblock()->saveIblockType(array (
  'ID' => 'catalog',
  'SECTIONS' => 'Y',
  'EDIT_FILE_BEFORE' => '',
  'EDIT_FILE_AFTER' => '',
  'IN_RSS' => 'N',
  'SORT' => '500',
  'LANG' => 
  array (
    'ru' => 
    array (
      'NAME' => 'Каталог',
      'SECTION_NAME' => '',
      'ELEMENT_NAME' => '',
    ),
    'en' => 
    array (
      'NAME' => 'Каталог',
      'SECTION_NAME' => '',
      'ELEMENT_NAME' => '',
    ),
  ),
));

    }

    public function down()
    {
        //your code ...
    }
}