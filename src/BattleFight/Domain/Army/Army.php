<?php declare(strict_types=1);

namespace BattleFight\Domain\Army;

use BattleFight\Domain\Unit\UnitInterface;

/**
 * Class Army
 * @package BattleFight\Domain\Army
 */
class Army implements ArmyInterface
{
    /** @var ArmyCollection */
    private $armyCollection;

    /**
     * Army constructor.
     */
    public function __construct()
    {
        $this->armyCollection = new ArmyCollection();
    }

    /**
     * @param UnitInterface $unit
     *
     * @return ArmyInterface
     */
    public function add(UnitInterface $unit): ArmyInterface
    {
        $this->armyCollection->add($unit->getUuid(), $unit);

        return $this;
    }

    /**
     * @param UnitInterface $unit
     *
     * @return ArmyInterface
     */
    public function remove(UnitInterface $unit): ArmyInterface
    {
        $this->armyCollection->remove($unit->getUuid());

        return $this;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return $this->armyCollection->count();
    }

    /**
     * @return ArmyCollection
     */
    public function getUnits(): ArmyCollection
    {
        return $this->armyCollection;
    }
}
