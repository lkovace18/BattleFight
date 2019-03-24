<?php declare(strict_types=1);

namespace BattleFight\Domain\Armor;

use BattleFight\Domain\Armor\Type\ArmorTypeInterface;

/**
 * Class Armor
 * @package BattleFight\Domain\Armor
 */
class Armor implements ArmorInterface
{
    /** @var ArmorTypeInterface */
    private $type;

    /**@var int */
    private $protection = 0;

    /**
     * Armor constructor.
     *
     * @param ArmorTypeInterface $type
     * @param int $protection
     */
    public function __construct(ArmorTypeInterface $type, int $protection)
    {
        $this->type = $type;
        $this->protection = $protection;
    }

    /**
     * @return int
     */
    public function getProtection(): int
    {
        return $this->protection;
    }

    /**
     * @return ArmorTypeInterface
     */
    public function getType(): ArmorTypeInterface
    {
        return $this->type;
    }
}
