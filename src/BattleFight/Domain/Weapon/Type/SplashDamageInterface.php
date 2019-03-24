<?php declare(strict_types=1);

namespace BattleFight\Domain\Weapon\Type;

/**
 * Interface SplashDamageInterface
 * @package BattleFight\Domain\Weapon\Type
 */
interface SplashDamageInterface
{
    public function getSplashDamageRange(): int;

    public function hasSplashDamage(): bool;
}
