<?php declare(strict_types=1);

namespace BattleFight\Test\Domain\Weapon;

use BattleFight\Domain\Exception\WeaponValidationException;
use BattleFight\Domain\Weapon\Type\RifleType;
use BattleFight\Domain\Weapon\Weapon;
use BattleFight\Domain\Weapon\WeaponInterface;
use PHPUnit\Framework\TestCase;


class WeaponTest extends TestCase
{
    /** @test */
    public function it_creates_weapon()
    {
        $weaponType = new RifleType();
        $weaponName = 'AK-47';
        $weapon = new Weapon($weaponType, $weaponName, 100);

        $this->assertTrue($weapon instanceof WeaponInterface);
        $this->assertSame(100, $weapon->getDamage());
        $this->assertSame($weaponName, $weapon->getName());
    }

    /** @test */
    public function it_validates_weapon_damage()
    {
        $this->expectException(WeaponValidationException::class);
        $this->expectExceptionMessage('Weapon damage must be in range 0 - 100');

        $weaponType = new RifleType();
        $weaponName = 'AK-47';
        $weapon = new Weapon($weaponType, $weaponName, -21);

        $this->assertTrue($weapon instanceof WeaponInterface);
    }

    /** @test */
    public function it_validates_weapon_name()
    {
        $this->expectException(WeaponValidationException::class);
        $this->expectExceptionMessage('Weapon name must be longer than 2 characters');

        $weaponType = new RifleType();
        $weaponName = 'ds';
        $weapon = new Weapon($weaponType, $weaponName, 40);

        $this->assertTrue($weapon instanceof WeaponInterface);
    }
}
