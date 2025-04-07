<?php
use PHPUnit\Framework\Attributes\DataProvider;

/**
 * Class BxxHelpersIBlocksTest
 */
class BxxHelpersIBlocksTest extends \PHPUnit\Framework\TestCase
{
    


    public static function lstIBlocksProvider(): array
    {
        \Bxx\Core::init(['iblock']);

        $rdb = \CIBlock::GetList(
                [],
                ['!CODE' => [false,'']]
            );

        $lstIBlocks = [];
        while ($dctIBlock = $rdb->fetch()) {
            $lstIBlocks[] = 
                [intval($dctIBlock['ID']),$dctIBlock['CODE']];
            if (count($lstIBlocks)>20) break;
        }

        return $lstIBlocks;
    }
    
    // тестирование получения id инфоблоков по коду ИБ
    #[DataProvider('lstIBlocksProvider')]
    public function testGetIdByCode(int $Id, string $Code): void
    {
        $this->assertSame(
                $Id,
                \Bxx\Helpers\IBlocks::getIdByCode($Code)
            );
    }


}