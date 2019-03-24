<?php declare(strict_types=1);

namespace BattleFight\Domain\Battle\Details;

/**
 * Class BattleDetails
 * @package BattleFight\Domain\Battle\Details
 */
class BattleDetails
{
    /** @var int */
    private $defenderDeployedUnits = 0;
    /** @var int */
    private $attackerDeployedUnits = 0;
    /** @var int */
    private $attackerDamageDealt = 0;
    /** @var int */
    private $defenderDamageDealt = 0;
    /** @var int */
    private $roundsCount = 0;
    /** @var int */
    private $fightsCount = 0;

    /**
     * BattleDetails constructor.
     *
     * @param int $attackerUnitCount
     * @param int $defenderUnitCount
     */
    public function __construct(int $attackerUnitCount, int $defenderUnitCount)
    {
        $this->attackerDeployedUnits = $attackerUnitCount;
        $this->defenderDeployedUnits = $defenderUnitCount;
    }
    /**
     * @return int
     */
    public function getDefenderDeployedUnits(): int
    {
        return $this->defenderDeployedUnits;
    }

    /**
     * @return int
     */
    public function getAttackerDeployedUnits(): int
    {
        return $this->attackerDeployedUnits;
    }

    /**
     * @return int
     */
    public function getAttackerDamageDealt(): int
    {
        return $this->attackerDamageDealt;
    }

    /**
     * @param int $attackerDamageDealt
     *
     * @return BattleDetails
     */
    public function incrementAttackerDamageDealt(int $attackerDamageDealt): BattleDetails
    {
        $this->attackerDamageDealt += $attackerDamageDealt;

        return $this;
    }

    /**
     * @return int
     */
    public function getDefenderDamageDealt(): int
    {
        return $this->defenderDamageDealt;
    }

    /**
     * @param int $defenderDamageDealt
     *
     * @return BattleDetails
     */
    public function incrementDefenderDamageDealt(int $defenderDamageDealt): BattleDetails
    {
        $this->defenderDamageDealt += $defenderDamageDealt;

        return $this;
    }

    /**
     * @return int
     */
    public function getRoundsCount(): int
    {
        return $this->roundsCount;
    }

    /**
     * @return BattleDetails
     */
    public function incrementRoundsCount(): BattleDetails
    {
        $this->roundsCount++;

        return $this;
    }

    /**
     * @return int
     */
    public function getFightsCount(): int
    {
        return $this->fightsCount;
    }

    /**
     * @param int $fights
     *
     * @return BattleDetails
     */
    public function incrementFightsCount(int $fights): BattleDetails
    {
        $this->fightsCount += $fights;

        return $this;
    }
}
