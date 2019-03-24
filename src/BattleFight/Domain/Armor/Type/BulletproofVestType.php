<?php declare(strict_types=1);

namespace BattleFight\Domain\Armor\Type;

/**
 * Class BulletproofVestType
 * @package BattleFight\Domain\Armor\Type
 */
class BulletproofVestType implements ArmorTypeInterface
{
    /**
     * @return string
     */
    public function __toString(): string
    {
        return self::class;
    }
}
