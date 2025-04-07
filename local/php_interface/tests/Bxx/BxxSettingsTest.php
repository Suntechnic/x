<?php
use PHPUnit\Framework\Attributes\DataProvider;

/**
 * Class BxxSettingsTest
 */
class BxxSettingsTest extends \PHPUnit\Framework\TestCase
{


    public function testOptions (): void
    {
        $this->assertNotSame(
                0,
                count(\Bxx\Settings::getOptionsInfo()),
                'Тестирование будет провалено, так как нет настроек'
            );
    }


    /**
     * Предоставляем список списков вида [ДефолтноеЗначениеПолученноеИзOptions, Code]
     */
    public static function arraysDefaultProvider(): array
    {
        $lst = [];
        foreach (\Bxx\Settings::getOptionsInfo() as $Code=>$dctOption) { if (!isset($dctOption['default'])) continue;
            $lst[] = [
                $Code,
                $dctOption['default']
            ];
        }
        return $lst;
    }
    /**
     * Проверяем что дефолтные значения совпадают с теми что в настройках
     * @dataProvider arraysDefaultProvider
     * @param string $Code Код настройки
     * @param mixed $DefaultValue Дефолтное значение
     * @return void
     */
    #[DataProvider('arraysDefaultProvider')]
    public function testDefaultOptions (
            string $Code, 
            $DefaultValue
        ): void
    {
        $this->assertSame(
                \Bxx\Settings::getOptionDefault($Code),
                $DefaultValue
            );
    }




    public function testIO (): void
    {
        $refOptionsInfo = \Bxx\Settings::getOptionsInfo();
        // Текущие значения
        $refOptions = \Bxx\Settings::getOptions();

        // проверить что массив совпадает настройками извлеченными по одной

        // удаляем все настройки
        foreach ($refOptions as $Code=>$_) \Bxx\Settings::delete($Code);

        // подготваливаем массив
        $lstTest = [];
        foreach ($refOptionsInfo as $Code=>$dctOption) { if (!isset($dctOption['default'])) continue;
            $this->assertSame(
                    \Bxx\Settings::get($Code),
                    $dctOption['default'],
                    "Код настройки $Code не совпадает с дефолтным значением"
                );
        }

        // восстанавливаем настройки
        $refOptionsAfterReup = \Bxx\Settings::setOptions($refOptions);
        $this->assertSame(
                $refOptions,
                $refOptionsAfterReup
            );

    }

}