<?php declare(strict_types=1);

namespace BattleFight\Domain\Army;

use BattleFight\Domain\Unit\UnitInterface;

/**
 * Interface ArmyInterface
 * @package BattleFight\Domain\Army
 */
interface ArmyInterface
{
    public function count(): int;

    public function add(UnitInterface $unit): ArmyInterface;

    public function getUnits(): ArmyCollection;
}
