<?php declare(strict_types=1);

namespace BattleFight\Domain\Weapon\Type;

/**
 * Interface WeaponTypeInterface
 * @package BattleFight\Domain\Weapon\Type
 */
interface WeaponTypeInterface
{
    /**
     * @todo: range should be value object in future when modifiers are finished and precision is added
     * @return string
     */
    public function getRange(): string;

    public function __toString(): string;
}
