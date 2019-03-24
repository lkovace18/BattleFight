<?php declare(strict_types=1);

namespace BattleFight\Domain\Battle;


use BattleFight\Domain\Army\ArmyInterface;
use BattleFight\Domain\Army\RoundCollection;
use BattleFight\Domain\Battle\Details\BattleDetails;
use BattleFight\Domain\Battle\Round\RoundInterface;
use BattleFight\Domain\Battlefield\BattlefieldInterface;
use BattleFight\Domain\Modifier\ModifierInterface;
use BattleFight\Domain\Utility\Traits\UuidTrait;

/**
 * Class Battle
 * @package BattleFight\Domain\Battle
 */
class Battle implements BattleInterface
{
    use UuidTrait;

    /** @var BattlefieldInterface */
    private $battlefield;

    /** @var ArmyInterface */
    private $attackingArmy;

    /** @var ArmyInterface */
    private $defendingArmy;

    /** @var ModifierCollection */
    private $modifiers;

    /** @var bool */
    private $finished = false;

    /** @var RoundCollection */
    private $rounds;

    /** @var BattleDetails */
    private $details;

    /**
     * Battle constructor.
     *
     * @param BattlefieldInterface $battlefield
     * @param ArmyInterface $attackingArmy
     * @param ArmyInterface $defendingArmy
     * @param ModifierInterface $modifiers
     */
    public function __construct(
        BattlefieldInterface $battlefield,
        ArmyInterface $attackingArmy,
        ArmyInterface $defendingArmy,
        ModifierCollection $modifiers
    ) {
        $this->uuid = $this->generateUuid();

        $this->battlefield = $battlefield;
        $this->attackingArmy = $attackingArmy;
        $this->defendingArmy = $defendingArmy;
        $this->modifiers = $modifiers;

        $this->rounds = new RoundCollection();
        $this->details = new BattleDetails(
            $this->attackingArmy->count(),
            $this->defendingArmy->count()
        );
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
     * @return BattleInterface
     */
    public function setFinished(bool $finished): BattleInterface
    {
        $this->finished = $finished;

        return $this;
    }

    /**
     * @param RoundInterface $round
     *
     * @return RoundInterface
     */
    public function addRound(RoundInterface $round): RoundInterface
    {
        $details =$this->details->incrementRoundsCount();
        $round->getDetails()->setRoundNumber($details->getRoundsCount());
        $this->rounds->add($round->getUuid(), $round);

        return $round;
    }

    /**
     * @return RoundCollection
     */
    public function getRounds(): RoundCollection
    {
        return $this->rounds;
    }

    /**
     * @return ArmyInterface
     */
    public function getAttackingArmy(): ArmyInterface
    {
        return $this->attackingArmy;
    }

    /**
     * @return ArmyInterface
     */
    public function getDefendingArmy(): ArmyInterface
    {
        return $this->defendingArmy;
    }

    /**
     * @return BattleDetails
     */
    public function getDetails(): BattleDetails
    {
        return $this->details;
    }

    /**
     * @return ModifierCollection
     */
    public function getModifiers(): ModifierCollection
    {
        return $this->modifiers;
    }
}
