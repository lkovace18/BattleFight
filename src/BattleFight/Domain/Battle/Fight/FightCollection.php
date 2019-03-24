<?php declare(strict_types=1);

namespace BattleFight\Domain\Army;

use BattleFight\Domain\Utility\ArrayCollection;

/**
 * Class FightCollection
 * @package BattleFight\Domain\Army
 */
class FightCollection extends ArrayCollection
{
    /**
     * FightCollection constructor.
     *
     * @param array $elements
     */
    public function __construct(array $elements = [])
    {
        parent::__construct($elements);
    }
}
