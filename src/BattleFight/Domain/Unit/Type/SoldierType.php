<?php declare(strict_types=1);

namespace BattleFight\Domain\Unit\Type;

/**
 * Class SoldierType
 * @package BattleFight\Domain\Unit\Type
 */
class SoldierType implements UnitTypeInterface
{
    /**
     * @return string
     */
    public function __toString(): string
    {
        return self::class;
    }
}
