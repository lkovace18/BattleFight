<?php declare(strict_types=1);

namespace BattleFight\Domain\Weapon\Type;

/**
 * Class PistolType
 * @package BattleFight\Domain\Weapon\Type
 */
class PistolType implements WeaponTypeInterface
{
    protected const RANGE = 'short';

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
