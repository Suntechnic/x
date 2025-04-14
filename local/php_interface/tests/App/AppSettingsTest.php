<?php
use PHPUnit\Framework\Attributes\DataProvider;

/**
 * Class AppSettingsTest
 */
class AppSettingsTest extends \PHPUnit\Framework\TestCase
{


    public function testOptions (): void
    {
        $this->assertNotSame(
                0,
                count(\App\Settings::getOptionsInfo()),
                'Тестирование будет провалено, так как нет настроек'
            );
    }


    /**
     * Предоставляем список списков вида [ДефолтноеЗначениеПолученноеИзOptions, Code]
     */
    public static function arraysDefaultProvider(): array
    {
        $lst = [];
        foreach (\App\Settings::getOptionsInfo() as $Code=>$dctOption) { if (!isset($dctOption['default'])) continue;
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
                \App\Settings::getOptionDefault($Code),
                $DefaultValue
            );
    }




    public function testIO (): void
    {
        $refOptionsInfo = \App\Settings::getOptionsInfo();
        // Текущие значения
        $refOptions = \App\Settings::getOptions();

        // проверить что массив совпадает настройками извлеченными по одной

        // удаляем все настройки
        foreach ($refOptions as $Code=>$_) \App\Settings::delete($Code);

        // подготваливаем массив
        $lstTest = [];
        foreach ($refOptionsInfo as $Code=>$dctOption) { if (!isset($dctOption['default'])) continue;
            $this->assertSame(
                    \App\Settings::get($Code),
                    $dctOption['default'],
                    "Код настройки $Code не совпадает с дефолтным значением"
                );
        }

        // восстанавливаем настройки
        $refOptionsAfterReup = \App\Settings::setOptions($refOptions);
        $this->assertSame(
                $refOptions,
                $refOptionsAfterReup
            );

    }

}