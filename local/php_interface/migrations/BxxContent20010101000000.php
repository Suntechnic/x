<?php

namespace Sprint\Migration;


class BxxContent20010101000000 extends Version
{
    protected $description = "Тип ИБ Контент";

    protected $moduleVersion = "4.1.3";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $helper->Iblock()->saveIblockType(array (
  'ID' => 'content',
  'SECTIONS' => 'Y',
  'EDIT_FILE_BEFORE' => '',
  'EDIT_FILE_AFTER' => '',
  'IN_RSS' => 'N',
  'SORT' => '500',
  'LANG' => 
  array (
    'ru' => 
    array (
      'NAME' => 'Контент',
      'SECTION_NAME' => '',
      'ELEMENT_NAME' => '',
    ),
    'en' => 
    array (
      'NAME' => 'Contents',
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
