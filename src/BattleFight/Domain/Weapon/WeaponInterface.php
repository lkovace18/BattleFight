<?php declare(strict_types=1);

namespace BattleFight\Domain\Weapon;

use BattleFight\Domain\Weapon\Type\WeaponTypeInterface;

/**
 * Interface WeaponInterface
 * @package BattleFight\Domain\Weapon
 */
interface WeaponInterface
{
    public function getDamage(): int;

    public function getName(): string;

    public function getType(): WeaponTypeInterface;
}
