<?php declare(strict_types=1);

namespace BattleFight\Domain\Battle\Fight;

use BattleFight\Domain\Unit\UnitInterface;

/**
 * Interface FightInterface
 * @package BattleFight\Domain\Battle\Fight
 */
interface FightInterface
{
    public function __construct(UnitInterface $attacker, UnitInterface $defender);

    public function defenderIsDead(): bool;

    public function attackerIsDead(): bool;

    public function getDefender(): UnitInterface;

    public function getAttacker(): UnitInterface;
}
