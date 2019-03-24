<?php declare(strict_types=1);

namespace BattleFight\Domain\Battle\Round;

use BattleFight\Domain\Army\ArmyInterface;
use BattleFight\Domain\Army\FightCollection;
use BattleFight\Domain\Battle\Fight\Fight;
use BattleFight\Domain\Battle\Round\Details\RoundDetails;
use BattleFight\Domain\Utility\Traits\UuidTrait;

/**
 * Class Round
 * @package BattleFight\Domain\Battle\Round
 */
class Round implements RoundInterface
{
    use UuidTrait;

    /** @var ArmyInterface */
    private $attackerArmy;

    /** @var ArmyInterface */
    private $defenderArmy;

    /** @var FightCollection */
    private $fights;

    /** @var bool */
    private $finished;

    /** @var RoundDetails */
    private $details;

    /**
     * Round constructor.
     *
     * @param ArmyInterface $attackerArmy
     * @param ArmyInterface $defenderArmy
     */
    public function __construct(ArmyInterface $attackerArmy, ArmyInterface $defenderArmy)
    {
        $this->uuid = $this->generateUuid();

        $this->attackerArmy = $attackerArmy;
        $this->defenderArmy = $defenderArmy;

        $this->fights = new FightCollection();

        $this->details = new RoundDetails(
            $this->attackerArmy->count(),
            $this->defenderArmy->count()
        );

        // reset pointer just to be safe here
        $attackerArmy->getUnits()->first();
        $defenderArmy->getUnits()->first();
        $this->finished = false;
    }


    /**
     * @return FightCollection
     */
    public function getFights(): FightCollection
    {
        return $this->fights;
    }


    /**
     * @param Fight $fight
     *
     * @return RoundInterface
     */
    public function addFight(Fight $fight): RoundInterface
    {
        $this->fights->add($fight->getUuid(), $fight);

        return $this;
    }

    /**
     * @return bool
     */
    public function isFinished(): bool
    {
        return $this->finished;
    }

    /**
     * @param bool $finished
     *
     * @return Round
     */
    public function setFinished(bool $finished): Round
    {
        $this->finished = $finished;

        return $this;
    }

    /**
     * @return ArmyInterface
     */
    public function getDefenderArmy(): ArmyInterface
    {
        return $this->defenderArmy;
    }

    /**
     * @return ArmyInterface
     */
    public function getAttackerArmy(): ArmyInterface
    {
        return $this->attackerArmy;
    }

    /**
     * @return RoundDetails
     */
    public function getDetails(): RoundDetails
    {
        return $this->details;
    }
}
