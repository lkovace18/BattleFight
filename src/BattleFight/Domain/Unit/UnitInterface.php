<?php declare(strict_types=1);

namespace BattleFight\Domain\Unit;

use BattleFight\Domain\Armor\ArmorInterface;
use BattleFight\Domain\Unit\Type\UnitTypeInterface;
use BattleFight\Domain\Weapon\WeaponInterface;

/**
 * Interface UnitInterface
 * @package BattleFight\Domain\Unit
 */
interface UnitInterface
{
    public function getHealth(): int;

    public function getDamage(): int;

    public function equipWeapon(WeaponInterface $weapon): UnitInterface;

    public function equipArmor(ArmorInterface $weapon): UnitInterface;

    public function getType(): UnitTypeInterface;

    public function getWeapon(): WeaponInterface;

    public function getArmor(): ?ArmorInterface;

    public function getUuid(): string;

    public function reduceHealth(int $damage): UnitInterface;
}
