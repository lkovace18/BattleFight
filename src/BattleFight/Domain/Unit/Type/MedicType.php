<?php declare(strict_types=1);

namespace BattleFight\Domain\Unit\Type;

/**
 * Class MedicType
 * @package BattleFight\Domain\Unit\Type
 */
class MedicType implements UnitTypeInterface
{
    /**
     * @return string
     */
    public function __toString(): string
    {
        return self::class;
    }
}
