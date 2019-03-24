<?php declare(strict_types=1);

namespace BattleFight\Domain\Battle\Round;

use BattleFight\Domain\Army\ArmyInterface;
use BattleFight\Domain\Army\FightCollection;
use BattleFight\Domain\Battle\Fight\Fight;
use BattleFight\Domain\Battle\Round\Details\RoundDetails;

/**
 * Interface RoundInterface
 * @package BattleFight\Domain\Battle\Round
 */
interface RoundInterface
{
    public function __construct(ArmyInterface $attackerArmy, ArmyInterface $defenderArmy);

    public function getFights(): FightCollection;

    public function getUuid(): string;

    public function getDetails(): RoundDetails;

    public function addFight(Fight $fight): RoundInterface;
}
