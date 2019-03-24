<?php declare(strict_types=1);

namespace BattleFight\Application\Factory;

use BattleFight\Domain\Exception\UnitTypeException;
use BattleFight\Domain\Unit\Type\MedicType;
use BattleFight\Domain\Unit\Type\SoldierType;
use BattleFight\Domain\Unit\Type\UnitTypeInterface;
use BattleFight\Domain\Unit\Unit;
use BattleFight\Domain\Unit\UnitInterface;

/**
 * Class UnitFactory
 * @package BattleFight\Application\Factory
 */
class UnitFactory
{
    /**
     * @param array $config
     *
     * @return UnitInterface
     * @throws UnitTypeException
     */
    public function create(array $config): UnitInterface
    {
        $unit = new Unit(
            $this->resolveUnitType($config['type']),
            (int)$config['attributes']['health'],
            (int)$config['attributes']['damage']
        );

        return $unit;
    }

    /**
     * @param string $type
     *
     * @return MedicType|SoldierType
     * @throws UnitTypeException
     */
    private function resolveUnitType(string $type): UnitTypeInterface
    {
        switch ($type) {
            case 'solider':
                return new SoldierType();
            case 'medic':
                return new MedicType();
            default:
                throw new UnitTypeException('Unknown unit type ' . $type);
        }
    }
}
