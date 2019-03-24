<?php declare(strict_types=1);

namespace BattleFight\Domain\Modifier;

/**
 * Interface ModifierInterface
 * @package BattleFight\Domain\Modifier
 */
interface ModifierInterface
{
    public function getModifierType(): string;

    public function getAffectType(): string;

    public function getName(): string;

    public function getModifyValue(): int;

    public function getChance(): int;
}
