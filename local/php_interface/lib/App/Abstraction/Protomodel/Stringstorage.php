<?
// \Model\Stringstorage::getInstance()->getStringVal();
/*
Список полей:
UF_XML_ID	Строка
UF_STRING	Строка
UF_NAME	Строка
Могут быть так же добавлены поля вид UF_STRING__{КОД_ЯЗЫКА} для вывода локализованных значений
*/
namespace App\Abstraction\Protomodel {
    class Stringstorage extends \App\Abstraction\HLBModel {
        
        // возвращает Значение строки по коду
        public function getStringVal (
                $xml_id,
                $search=false,
                $replace=''
            ) {
            $arElement = $this->setFilter(['UF_XML_ID'=>$xml_id])->getElement();
            
            if ($arElement['UF_STRING__'.LANGUAGE_UID]) {
                $str = $arElement['UF_STRING__'.LANGUAGE_UID];
            } else {
                $str = $arElement['UF_STRING'];
            }
            
            if ($search) $str = str_replace($search,$replace,$str);
            return $str;
        }
        #
        
    }
}