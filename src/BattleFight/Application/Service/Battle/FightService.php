<?php declare(strict_types=1);

namespace BattleFight\Application\Service\Battle;


use BattleFight\Domain\Battle\Fight\Details\FightDetails;
use BattleFight\Domain\Battle\Fight\Fight;
use BattleFight\Domain\Unit\UnitInterface;

/**
 * Class FightService
 * @package BattleFight\Application\Service
 */
class FightService
{
    /**
     * @param UnitInterface $attackingUnit
     * @param UnitInterface $defendingUnit
     *
     * @return Fight
     */
    public function resolve(UnitInterface $attackingUnit, UnitInterface $defendingUnit): Fight
    {
        $fight = new Fight(
            $attackingUnit,
            $defendingUnit
        );

        $fight->setDetails(new FightDetails(
            $fight->getAttacker()->getHealth(),
            $fight->getAttacker()->getDamage(),
            $fight->getAttacker()->getDamage(),
            $fight->getDefender()->getHealth(),
            $fight->getDefender()->getDamage(),
            $fight->getDefender()->getDamage()
        ));

        $fight->getAttacker()
            ->reduceHealth($fight->getDefender()->getDamage())
            ->getHealth();

        $fight->getDefender()
            ->reduceHealth($fight->getAttacker()->getDamage())
            ->getHealth();

        return $fight;
    }
}
