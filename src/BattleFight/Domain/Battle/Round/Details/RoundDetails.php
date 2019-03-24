<?php declare(strict_types=1);

namespace BattleFight\Domain\Battle\Round\Details;

/**
 * Class RoundDetails
 * @package BattleFight\Domain\Battle\Round\Details
 */
class RoundDetails
{
    /** @var int */
    private $fightsCount = 0;

    /** @var int */
    private $attackerArmyCount;

    /** @var int */
    private $defenderArmyCount;

    /** @var int */
    private $roundNumber;

    /**
     * RoundDetails constructor.
     *
     * @param int $attackerArmyCount
     * @param int $defenderArmyCount
     */
    public function __construct(
        int $attackerArmyCount,
        int $defenderArmyCount
    ) {
        $this->attackerArmyCount = $attackerArmyCount;
        $this->defenderArmyCount = $defenderArmyCount;
    }

    /**
     * @return int
     */
    public function getFightsCount(): int
    {
        return $this->fightsCount;
    }

    /**
     * @return int
     */
    public function incrementFightsCount(): int
    {
        return $this->fightsCount++;
    }

    /**
     * @return int
     */
    public function getRoundNumber(): int
    {
        return $this->roundNumber;
    }

    /**
     * @param int $roundNumber
     *
     * @return RoundDetails
     */
    public function setRoundNumber(int $roundNumber): RoundDetails
    {
        $this->roundNumber = $roundNumber;

        return $this;
    }

    /**
     * @return int
     */
    public function getAttackerArmyCount(): int
    {
        return $this->attackerArmyCount;
    }

    /**
     * @return int
     */
    public function getDefenderArmyCount(): int
    {
        return $this->defenderArmyCount;
    }
}
