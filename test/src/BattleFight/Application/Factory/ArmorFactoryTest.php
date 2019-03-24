<?php declare(strict_types=1);

namespace BattleFight\Test\Factory;

use BattleFight\Application\Factory\ArmorFactory;
use BattleFight\Domain\Armor\ArmorInterface;
use BattleFight\Domain\Exception\ArmorTypeException;
use PHPUnit\Framework\TestCase;


class ArmorFactoryTest extends TestCase
{
    /** @test */
    public function it_generates_armor_from_config()
    {
        $config = [
            'type' => 'bulletproofVest',
            'attributes' => [
                'protection' => '30',
            ],
        ];

        $armor = (new ArmorFactory)->create($config);

        $this->assertTrue($armor instanceof ArmorInterface);
        $this->assertSame(30, $armor->getProtection());
    }

    /** @test */
    public function it_throws_exception_if_armor_type_does_not_exist()
    {
        $this->expectException(ArmorTypeException::class);

        $config = [
            'type' => 'unknownType',
            'attributes' => [
                'protection' => '100',
            ],
        ];

        (new ArmorFactory)->create($config);
    }
}
