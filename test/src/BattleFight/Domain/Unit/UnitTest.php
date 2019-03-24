<?php declare(strict_types=1);

namespace BattleFight\Test\Domain\Unit;

use BattleFight\Domain\Armor\Armor;
use BattleFight\Domain\Armor\ArmorInterface;
use BattleFight\Domain\Armor\Type\BulletproofVestType;
use BattleFight\Domain\Exception\UnitValidationException;
use BattleFight\Domain\Unit\Type\SoldierType;
use BattleFight\Domain\Unit\Unit;
use BattleFight\Domain\Unit\UnitInterface;
use BattleFight\Domain\Weapon\Type\RifleType;
use BattleFight\Domain\Weapon\Weapon;
use BattleFight\Domain\Weapon\WeaponInterface;
use PHPUnit\Framework\TestCase;


class UnitTest extends TestCase
{
    /** @test */
    public function it_creates_unit()
    {
        $unitType = new SoldierType();
        $unit = new Unit($unitType, 100);

        $this->assertTrue($unit instanceof UnitInterface);
    }

    /** @test */
    public function it_validates_unit_health()
    {
        $this->expectException(UnitValidationException::class);

        $unitType = new SoldierType();
        $unit = new Unit($unitType, -21);

        $this->assertTrue($unit instanceof UnitInterface);
    }

    /** @test */
    public function it_adds_damage_of_equiped_weapon()
    {
        $unit = new Unit(new SoldierType(), 100, 10);
        $weapon = new Weapon(new RifleType(), 'AK-47', 30);

        $unit->equipWeapon($weapon);

        $this->assertTrue($unit->getWeapon() instanceof WeaponInterface);
        $this->assertSame(40, $unit->getDamage());
    }

    /** @test */
    public function it_adds_protection_from_equiped_armor()
    {
        $unit = new Unit(new SoldierType(), 100, 10);
        $armor = new Armor(new BulletproofVestType(), 30);

        $unit->equipArmor($armor);

        $this->assertTrue($unit->getArmor() instanceof ArmorInterface);
        $this->assertSame(130, $unit->getHealth());
    }
}
