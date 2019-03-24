<?php declare(strict_types=1);

namespace BattleFight\Test\Factory;

use BattleFight\Application\Factory\UnitFactory;
use BattleFight\Domain\Exception\UnitTypeException;
use BattleFight\Domain\Unit\UnitInterface;
use PHPUnit\Framework\TestCase;


class UnitFactoryTest extends TestCase
{
    /** @test */
    public function it_generates_unit_from_config()
    {
        $config = [
            'type' => 'solider',
            'attributes' => [
                'health' => '100',
                'damage' => '20',
            ],
        ];

        $unit = (new UnitFactory)->create($config);

        $this->assertTrue($unit instanceof UnitInterface);
        $this->assertSame(100, $unit->getHealth());
        $this->assertSame(20, $unit->getDamage());
    }

    /** @test */
    public function it_throws_exception_if_unit_type_does_not_exist()
    {
        $this->expectException(UnitTypeException::class);

        $config = [
            'type' => 'unknownType',
            'attributes' => [
                'health' => '100',
                'damage' => '20',
            ],
        ];

        (new UnitFactory)->create($config);
    }
}
