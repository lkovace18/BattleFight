<?php declare(strict_types=1);

namespace BattleFight\Domain\Battle\Fight\Details;

/**
 * Class FightDetails
 * @package BattleFight\Domain\Battle\Fight\Details
 */
class FightDetails implements FightDetailsInterface
{
    /** @var int */
    private $fightNumber;

    /** @var int */
    private $attackerHealth;

    /** @var int */
    private $attackerDamage;

    /** @var int */
    private $attackerDamageDealt;

    /** @var int */
    private $defenderHealth;

    /** @var int */
    private $defenderDamageDealt;

    /** @var int */
    private $defenderDamage;

    /**
     * FightDetails constructor.
     *
     * @param int $attackerHealth
     * @param int $attackerDamage
     * @param int $attackerDamageDealt
     * @param int $defenderHealth
     * @param int $defenderDamage
     * @param int $defenderDamageDealt
     */
    public function __construct(
        int $attackerHealth,
        int $attackerDamage,
        int $attackerDamageDealt,
        int $defenderHealth,
        int $defenderDamage,
        int $defenderDamageDealt
    ) {
        $this->attackerHealth = $attackerHealth;
        $this->attackerDamage = $attackerDamage;
        $this->attackerDamageDealt = $attackerDamageDealt;
        $this->defenderHealth = $defenderHealth;
        $this->defenderDamageDealt = $defenderDamageDealt;
        $this->defenderDamage = $defenderDamage;
    }

    /**
     * @return int
     */
    public function getAttackerDamage(): int
    {
        return $this->attackerDamage;
    }

    /**
     * @return int
     */
    public function getAttackerDamageDealt(): int
    {
        return $this->attackerDamageDealt;
    }

    /**
     * @return int
     */
    public function getDefenderHealth(): int
    {
        return $this->defenderHealth;
    }

    /**
     * @return int
     */
    public function getDefenderDamageDealt(): int
    {
        return $this->defenderDamageDealt;
    }

    /**
     * @return int
     */
    public function getAttackerHealth(): int
    {
        return $this->attackerHealth;
    }

    /**
     * @return int
     */
    public function getDefenderDamage(): int
    {
        return $this->defenderDamage;
    }

    /**
     * @return int
     */
    public function getFightNumber(): int
    {
        return $this->fightNumber;
    }

    /**
     * @param int $fightNumber
     *
     * @return FightDetails
     */
    public function setFightNumber(int $fightNumber): FightDetails
    {
        $this->fightNumber = $fightNumber;

        return $this;
    }
}
