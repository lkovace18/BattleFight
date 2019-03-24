<?php declare(strict_types=1);

namespace BattleFight\Application\Service\Modifiers;

use BattleFight\Domain\Modifier\Modifier;
use BattleFight\Domain\Modifier\ModifierCollection;
use BattleFight\Domain\Modifier\ModifierInterface;

/**
 * Class ModifierService
 * @package BattleFight\Application\Service
 */
class ModifierService
{
    public function getRandomBattleModifier(ModifierCollection $modifiers): ?ModifierInterface
    {
        if ($modifiers->isEmpty()) {
            return null;
        }

        return $this->getRandomModifier($modifiers->toArray());
    }

    private function getRandomModifier(array $array): Modifier
    {
        return $array[array_rand($array)];
    }

    public function applyBattleModifier($battle): void
    {

    }
}
