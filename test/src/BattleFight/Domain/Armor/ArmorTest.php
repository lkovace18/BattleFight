<?php declare(strict_types=1);

namespace BattleFight\Test\Domain\Armor;

use BattleFight\Domain\Armor\Armor;
use BattleFight\Domain\Armor\ArmorInterface;
use BattleFight\Domain\Armor\Type\BulletproofVestType;
use PHPUnit\Framework\TestCase;


class ArmorTest extends TestCase
{
    /** @test */
    public function it_creates_armor()
    {
        $armorType = new BulletproofVestType();
        $armor = new Armor($armorType, 30);

        $this->assertTrue($armor instanceof ArmorInterface);
        $this->assertSame(30, $armor->getProtection());
    }
}
