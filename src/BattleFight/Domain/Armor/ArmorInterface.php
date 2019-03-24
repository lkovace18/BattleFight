<?php declare(strict_types=1);

namespace BattleFight\Domain\Armor;

use BattleFight\Domain\Armor\Type\ArmorTypeInterface;

/**
 * Interface ArmorInterface
 * @package BattleFight\Domain\Armor
 */
interface ArmorInterface
{
    public function getProtection(): int;

    public function getType(): ArmorTypeInterface;
}
