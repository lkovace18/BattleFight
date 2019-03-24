<?php declare(strict_types=1);

namespace BattleFight\Domain\Battle\Fight;

use BattleFight\Domain\Battle\Fight\Details\FightDetails;
use BattleFight\Domain\Battle\Fight\Details\FightDetailsInterface;
use BattleFight\Domain\Exception\FightValidationException;
use BattleFight\Domain\Unit\UnitInterface;
use BattleFight\Domain\Utility\Traits\UuidTrait;

/**
 * Class Fight
 * @package BattleFight\Domain\Battle\Fight
 */
class Fight implements FightInterface
{
    use UuidTrait;

    /** @var UnitInterface */
    private $attacker;

    /** @var UnitInterface */
    private $defender;

    /** @var FightDetails */
    private $details;

    /**
     * Fight constructor.
     *
     * @param UnitInterface $attacker
     * @param UnitInterface $defender
     */
    public function __construct(UnitInterface $attacker, UnitInterface $defender)
    {
        $this->uuid = $this->generateUuid();

        if ($attacker === $defender) {
            throw new FightValidationException('Defender and attacker are same person.');
        }

        $this->attacker = $attacker;
        $this->defender = $defender;

        if ($this->defenderIsDead() || $this->attackerIsDead()) {
            throw new FightValidationException('Dead people cannot fight, yet');
        }
    }

    /**
     * @return FightDetailsInterface
     */
    public function getDetails(): FightDetailsInterface
    {
        return $this->details;
    }

    /**
     * @param FightDetails $details
     *
     * @return FightDetails
     */
    public function setDetails(FightDetails $details)
    {
        return $this->details = $details;
    }

    /**
     * @return bool
     */
    public function defenderIsDead(): bool
    {
        return $this->defender->getHealth() <= 0;
    }

    /**
     * @return bool
     */
    public function attackerIsDead(): bool
    {
        return $this->attacker->getHealth() <= 0;
    }

    /**
     * @return UnitInterface
     */
    public function getDefender(): UnitInterface
    {
        return $this->defender;
    }

    /**
     * @return UnitInterface
     */
    public function getAttacker(): UnitInterface
    {
        return $this->attacker;
    }
}
