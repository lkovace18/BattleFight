<?php declare(strict_types=1);

namespace BattleFight\Domain\Modifier;

use BattleFight\Domain\Utility\ArrayCollection;

/**
 * Class ModifierCollection
 * @package BattleFight\Domain\Army
 */
class ModifierCollection extends ArrayCollection
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
