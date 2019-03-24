<?php declare(strict_types=1);

namespace BattleFight\Domain\Weapon\Type;

/**
 * Class RifleType
 * @package BattleFight\Domain\Weapon\Type
 */
class RifleType implements WeaponTypeInterface
{
    protected const RANGE = 'medium';

    /**
     * @return string
     */
    public function getRange(): string
    {
        return self::RANGE;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return self::class;
    }
}
