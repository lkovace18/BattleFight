<?php declare(strict_types=1);

namespace BattleFight\Domain\Battle\Fight\Details;

/**
 * Interface FightDetailsInterface
 * @package BattleFight\Domain\Battle\Fight\Details
 */
interface FightDetailsInterface
{
    public function __construct(
        int $attackerHealth,
        int $attackerDamage,
        int $attackerDamageDealt,
        int $defenderHealth,
        int $defenderDamage,
        int $defenderDamageDealt
    );

    public function getAttackerHealth(): int;

    public function getAttackerDamage(): int;

    public function getDefenderHealth(): int;

    public function getDefenderDamage(): int;

    public function getAttackerDamageDealt(): int;

    public function getDefenderDamageDealt(): int;
}
