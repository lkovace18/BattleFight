<?php declare(strict_types=1);

namespace BattleFight\Test\Factory;

use BattleFight\Application\Factory\WeaponFactory;
use BattleFight\Domain\Weapon\WeaponInterface;
use BattleFight\Domain\Exception\WeaponTypeException;
use PHPUnit\Framework\TestCase;


class WeaponFactoryTest extends TestCase
{
    /** @test */
    public function it_generates_weapon_from_config()
    {
        $config = [
            'type' => 'rifle',
            'attributes' => [
                'name' => 'Dummy AK-47',
                'damage' => 30,
            ],
        ];

        $weapon = (new WeaponFactory)->create($config);

        $this->assertTrue($weapon instanceof WeaponInterface);
        $this->assertSame(30, $weapon->getDamage());
        $this->assertSame('Dummy AK-47', $weapon->getName());
    }

    /** @test */
    public function it_throws_exception_if_weapon_type_does_not_exist()
    {
        $this->expectException(WeaponTypeException::class);

        $config = [
            'type' => 'unknownType',
            'attributes' => [
                'protection' => '100',
            ],
        ];

        (new WeaponFactory)->create($config);
    }
}
