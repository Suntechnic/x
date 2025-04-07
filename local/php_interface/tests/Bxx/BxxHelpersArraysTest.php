<?php
use PHPUnit\Framework\Attributes\DataProvider;

/**
 * Class BxxHelpersArraysTest
 */
class BxxHelpersArraysTest extends \PHPUnit\Framework\TestCase
{



    public static function arraysCleanProvider(): array
    {
        return [
            [['ID' => 1,'~ID' => 1], ['ID' => 1]],
            [['ID' => 7,'~ID' => 1, 'PROPERTY_T_VALUE' => 100], ['ID' => 7, 'PROPERTY_T_VALUE' => 100]],
            [['ID' => 7,'~ID' => 1, 'PROPERTY_T_VALUE_ID' => 100], ['ID' => 7]],
        ];
    }
    
    #[DataProvider('arraysCleanProvider')]
    public function testArraysClean(array $dctInput, array $dctOutput): void
    {
        $this->assertSame(
                $dctOutput,
                \Bxx\Helpers\Arrays::clean($dctInput)
            );
    }


    // public static function arraysMapProvider(): array
    // {
    //     return [
    //         [['ID' => 1,'~ID' => 1], 'ID', ['ID' => 1]],
    //         [['ID' => 7,'~ID' => 1, 'PROPERTY_T_VALUE' => 100], ['ID' => 7, 'PROPERTY_T_VALUE' => 100]],
    //         [['ID' => 7,'~ID' => 1, 'PROPERTY_T_VALUE_ID' => 100], ['ID' => 7]],
    //     ];
    // }
    // // тестирование получения карты
    // #[DataProvider('arraysMapProvider')]
    // public function testArraysMap(array $dctInput, array $dctOutput): void
    // {
    //     $this->assertSame(
    //             $dctOutput,
    //             \Bxx\Helpers\Arrays::clean($dctInput)
    //         );
    // }


}