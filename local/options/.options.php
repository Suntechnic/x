<?
return [
        'test1_bool' => [
                'tab' => 'Первый тестовый набор',
                'title' => 'Да',
                'default' => true,
                'type' => 'bool'
            ],
        'test1_float' => [
                'tab' => 'Первый тестовый набор',
                'title' => 'Число с плавающей точкой',
                'default' => 1.28,
                'type' => 'float'
            ],
        'test1_int' => [
                'tab' => 'Первый тестовый набор',
                'title' => 'Число',
                'default' => 17,
                'type' => 'integer'
            ],
        'test2_bool' => [
                'tab' => 'Второй тестовый набор',
                'title' => 'Нет',
                'default' => false,
                'type' => 'bool'
            ],
        'test2_string' => [
                'tab' => 'Второй тестовый набор',
                'title' => 'Строка',
                'default' => 'Строка',
                'type' => 'string'
            ],
        'test2_int' => [
                'tab' => 'Второй тестовый набор',
                'title' => 'Большое число',
                'hint' => 'это число побольше )))',
                'default' => 100,
                'type' => 'integer',
                //'exampleMethod' => '\App\Settings::deliveryExample'
            ],
        'debug' => [
                'tab' => 'Отладка',
                'title' => 'Отладка',
                'default' => false,
                'type' => 'bool',
            ],
    ];


/**
 * 
 * В класс App\Settings добавить метод deliveryExample
public static function deliveryExample (): string
{
    $HTML = '';

    $lstPrices = [
            \App\Settings::getOption('dlvr_cheapgoods')/2,
            \App\Settings::getOption('dlvr_cheapgoods')*10
        ];
    $lstTimes = [
        \App\Settings::getOption('dlvr_opentime')-1,
        \App\Settings::getOption('dlvr_opentime')+1,
        \App\Settings::getOption('dlvr_closetime')-1,
        \App\Settings::getOption('dlvr_closetime')+1,
    ];

    foreach ($lstPrices as $Price) {
    foreach ($lstTimes as $Time) {
        $lstRule = \App\Delivery::getRules($Price,$Time);
        $HTML.= '<div style="padding:8px">Для товара стомостью '.$Price.' в '.$Time.'ч. доставка будет:<br>';
        $HTML.= implode('<br>',$lstRule).'</div>';
    }
    }
    
    return $HTML;
}
 */