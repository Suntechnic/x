<?
return [
        
    ];


/**
 * Exemple of usage:
 * 
return [
        'onlinecredit' => [
                'tab' => 'Кредит',
                'title' => 'Онлайн кредитование',
                'default' => true,
                'type' => 'bool'
            ],
        'onlinecreditK' => [
                'tab' => 'Кредит',
                'title' => 'Множетель для рассчета ставки на 24 месяца',
                'default' => 1.28,
                'type' => 'float'
            ],
        'priceup' => [
                'tab' => 'Цены',
                'title' => 'Процент увеличения Второй цены',
                'default' => 6,
                'type' => 'integer'
            ],
        'priceplaceholder' => [
                'tab' => 'Цены',
                'title' => 'Фраза для вывода вместо цены',
                'default' => 'Цену уточняйте',
                'type' => 'string'
            ],
        'dlvr_closetime' => [
                'tab' => 'Доставка',
                'title' => 'Закрытие доставки',
                'hint' => 'товары заказанные после этого времени доставляются на следующий день',
                'default' => 19,
                'type' => 'integer',
                'exampleMethod' => '\App\Settings::deliveryExample'
            ],
        
    ];
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