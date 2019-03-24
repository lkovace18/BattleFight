<?php declare(strict_types=1);

namespace BattleFight\Application\Service\Battle;

use BattleFight\Domain\Army\ArmyInterface;
use BattleFight\Domain\Battle\Battle;
use BattleFight\Domain\Battlefield\BattlefieldInterface;
use BattleFight\Domain\Modifier\ModifierInterface;

/**
 * Class BattleService
 * @package BattleFight\Application\Service
 */
class BattleService
{
    /** @var RoundService */
    private $roundService;

    /**
     * BattleService constructor.
     *
     * @param RoundService $roundService
     */
    public function __construct(RoundService $roundService)
    {
        $this->roundService = $roundService;
    }

    /**
     * @param BattlefieldInterface $battlefield
     * @param ArmyInterface $attackingArmy
     * @param ArmyInterface $defendingArmy
     * @param ModifierInterface $modifiers
     *
     * @return Battle
     */
    public function fight(
        BattlefieldInterface $battlefield,
        ArmyInterface $attackingArmy,
        ArmyInterface $defendingArmy,
        ModifierInterface $modifiers
    ): Battle {

        $battle = new Battle($battlefield, $attackingArmy, $defendingArmy, $modifiers);

        while ($battle->isFinished() === false) {

            $this->resolveRound($battle);

            if ($this->battleIsOver($battle)) {
                $battle->setFinished(true);
            }
        }

        return $battle;
    }

    /**
     * @param Battle $battle
     */
    private function resolveRound(Battle $battle): void
    {
        $round = $this->roundService->resolve($battle);

        $battle->addRound($round);

        unset($round);
    }

    /**
     * @param Battle $battle
     *
     * @return bool
     */
    private function battleIsOver(Battle $battle): bool
    {
        return $battle->getAttackingArmy()->count() === 0 || $battle->getDefendingArmy()->count() === 0;
    }
}
