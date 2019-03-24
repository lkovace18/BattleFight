<?php declare(strict_types=1);

namespace BattleFight\Domain\Army;

use BattleFight\Domain\Utility\ArrayCollection;

/**
 * Class RoundCollection
 * @package BattleFight\Domain\Army
 */
class RoundCollection extends ArrayCollection
{
    /**
     * RoundCollection constructor.
     *
     * @param array $elements
     */
    public function __construct(array $elements = [])
    {
        parent::__construct($elements);
    }
}
