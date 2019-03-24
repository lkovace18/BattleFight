<?php declare(strict_types=1);

namespace BattleFight\Domain\Modifier;

/**
 * Class Modifier
 * @package BattleFight\Domain\Modifier
 */
class Modifier implements ModifierInterface
{
    public const
        BATTLEFIELD_MODIFIER_TYPE = 'battelfield_modifier',
        ROUND_MODIFIER_TYPE = 'round_modifier',
        UNIT_MODIFIER_TYPE = 'unit_modifier';

    public const
        HEALTH_MODIFIER = 'health_modifier',
        DAMAGE_MODIFIER = 'damage_modifier';

    /** @var string */
    private $modifierType;

    /** @var string */
    private $affectType;

    /** @var string */
    private $name;

    /** @var int */
    private $modifyValue;

    /**@var int */
    private $chance;

    /**
     * Modifier constructor.
     *
     * @param string $modifierType
     * @param string $affectType
     * @param string $name
     * @param int $modifyValue
     * @param int $chance
     * @todo add validation
     */
    public function __construct(
        string $modifierType,
        string $affectType,
        string $name,
        int $modifyValue,
        int $chance
    ) {
        $this->modifierType = $modifierType;
        $this->affectType = $affectType;
        $this->name = $name;
        $this->modifyValue = $modifyValue;
        $this->chance = $chance;
    }

    /**
     * @return string
     */
    public function getModifierType(): string
    {
        return $this->modifierType;
    }

    /**
     * @return string
     */
    public function getAffectType(): string
    {
        return $this->affectType;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getModifyValue(): int
    {
        return $this->modifyValue;
    }

    /**
     * @return int
     */
    public function getChance(): int
    {
        return $this->chance;
    }
}
