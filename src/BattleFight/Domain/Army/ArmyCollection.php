<?php declare(strict_types=1);

namespace BattleFight\Domain\Army;

use BattleFight\Domain\Utility\ArrayCollection;

/**
 * Class ArmyCollection
 * @package BattleFight\Domain\Army
 */
class ArmyCollection extends ArrayCollection
{
    /**
     * ArmyCollection constructor.
     *
     * @param array $elements
     */
    public function __construct(array $elements = [])
    {
        parent::__construct($elements);
    }
}
