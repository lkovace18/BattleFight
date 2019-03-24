<?php declare(strict_types=1);

namespace BattleFight\Application\Service\Battle;


use BattleFight\Domain\Army\ArmyCollection;
use BattleFight\Domain\Battle\Battle;
use BattleFight\Domain\Battle\Fight\Fight;
use BattleFight\Domain\Battle\Round\Round;
use BattleFight\Domain\Battle\Round\RoundInterface;

/**
 * Class RoundService
 * @package BattleFight\Application\Service
 */
class RoundService
{
    /** @var FightService */
    private $fightService;

    /**
     * RoundService constructor.
     *
     * @param FightService $fightService
     */
    public function __construct(FightService $fightService)
    {
        $this->fightService = $fightService;
    }

    /**
     * @param Battle $battle
     *
     * @return RoundInterface
     */
    public function resolve(Battle $battle): RoundInterface
    {
        $round = new Round(
            $battle->getAttackingArmy(),
            $battle->getDefendingArmy()
        );

        $attackingUnits = $round->getAttackerArmy()->getUnits();
        $defendingUnits = $round->getDefenderArmy()->getUnits();

        while ($round->isFinished() === false) {

            $fight = $this->resolveFight($round);

            $round->getFights()->add($fight->getUuid(), $fight);

            if ($this->roundIsOver($attackingUnits, $defendingUnits)) {
                $round->setFinished(true);
            }

            // clean up
            unset($fight);
        }

        return $round;
    }

    /**
     * @param Round $round
     *
     * @return Fight
     */
    private function resolveFight(Round $round): Fight
    {
        $attackingUnit = $round->getAttackerArmy()->getUnits()->current();
        $defendingUnit = $round->getDefenderArmy()->getUnits()->current();

        $fight = $this->fightService->resolve($attackingUnit, $defendingUnit);

        if ($fight->defenderIsDead()) {
            $round->getDefenderArmy()->getUnits()->remove($defendingUnit->getUuid());
        }

        if ($fight->attackerIsDead()) {
            $round->getAttackerArmy()->getUnits()->remove($attackingUnit->getUuid());
        }

        // clean up
        unset($attackingUnit);
        unset($defendingUnit);

        return $fight;
    }

    /**
     * @param ArmyCollection $attackingUnits
     * @param ArmyCollection $defendingUnits
     *
     * @return bool
     */
    private function roundIsOver(ArmyCollection $attackingUnits, ArmyCollection $defendingUnits): bool
    {
        return $attackingUnits->next() === false || $defendingUnits->next() === false;
    }
}
