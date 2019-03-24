<?php declare(strict_types=1);

namespace BattleFight\Domain\Battle;

use BattleFight\Domain\Army\ArmyInterface;
use BattleFight\Domain\Army\RoundCollection;
use BattleFight\Domain\Battle\Round\RoundInterface;
use BattleFight\Domain\Battlefield\BattlefieldInterface;
use BattleFight\Domain\Modifier\ModifierInterface;

/**
 * Interface BattleInterface
 * @package BattleFight\Domain\Battle
 */
interface BattleInterface
{
    public function __construct(
        BattlefieldInterface $battlefield,
        ArmyInterface $attackingArmy,
        ArmyInterface $defendingArmy,
        ModifierInterface $modifiers
    );

    public function isFinished(): bool;

    public function addRound(RoundInterface $round): RoundInterface;

    public function getRounds(): RoundCollection;
}
