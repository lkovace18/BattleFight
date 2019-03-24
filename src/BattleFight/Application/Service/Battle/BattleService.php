<?php declare(strict_types=1);

namespace BattleFight\Application\Service\Battle;

use BattleFight\Application\Service\Utility\ChanceService;
use BattleFight\Domain\Army\Army;
use BattleFight\Domain\Army\ArmyInterface;
use BattleFight\Domain\Battle\Battle;
use BattleFight\Domain\Battlefield\BattlefieldInterface;
use BattleFight\Domain\Modifier\Modifier;
use BattleFight\Domain\Modifier\ModifierCollection;
use BattleFight\Domain\Modifier\ModifierInterface;
use BattleFight\Domain\Unit\UnitInterface;

/**
 * Class BattleService
 * @package BattleFight\Application\Service
 */
class BattleService
{
    /** @var RoundService */
    private $roundService;

    /** @var ChanceService */
    private $chanceService;

    /**
     * BattleService constructor.
     *
     * @param RoundService $roundService
     */
    public function __construct(RoundService $roundService)
    {
        $this->roundService = $roundService;
        $this->chanceService = new ChanceService();
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

        $this->applyPreBattleModifiers($battle->getModifiers());

        while ($battle->isFinished() === false) {

            $this->resolveRound($battle);

            if ($this->battleIsOver($battle)) {
                $battle->setFinished(true);
            }
        }

        return $battle;
    }

    /**
     * @param ModifierCollection $modifiers
     * @param Battle $battle
     *
     * @return Battle
     */
    private function applyPreBattleModifiers(ModifierCollection $modifiers, Battle $battle): Battle
    {
        while ($modifier = $modifiers->current() !== false) {

            if($this->chanceService($modifier->getChance())) {
                $this->applyModifier($modifier, $battle);
            }

            $modifiers->next();
        }

        return $battle;
    }

    /**
     * @param Modifier $modifier
     * @param Army $army
     */
    private function applyModifier(Modifier $modifier, Army $army): void
    {
        $units = $army->getUnits();

        while ($unit = $units->current() !== false) {

            if ($modifier->getAffectType() === Modifier::HEALTH_MODIFIER) {
                $unit->reduceHealth($modifier->getModifyValue());

            } elseif ($modifier->getAffectType() === Modifier::DAMAGE_MODIFIER) {
                $unit->reduceAttack($modifier->getModifyValue());
            }


            $units->next();
        }
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
