<?php declare(strict_types=1);

namespace BattleFight\Application\Service\Report;

use BattleFight\Domain\Battle\Battle;

/**
 * Class ReportService
 * @package BattleFight\Application\Service\Report
 */
class ReportService implements ReportServiceInterface
{
    /** @var Battle */
    private $battle;

    /**
     * ReportService constructor.
     *
     * @param Battle $battle
     */
    public function __construct(Battle $battle)
    {
        $this->battle = $battle;
    }

    /**
     * @todo add templating engine ( blade or twig)
     */
    public function render(): void
    {
        echo "<h1>Battle Details: </h1>";

        if ($this->battle->getAttackingArmy()->count() <= 0 && $this->battle->getDefendingArmy()->count() > 0) {
            echo "<h2>Defender Wins, units left: " . $this->battle->getDefendingArmy()->count() . "</h2>";
        } elseif ($this->battle->getDefendingArmy()->count() <= 0 && $this->battle->getAttackingArmy()->count() > 0) {
            echo "<h2>Attacker Wins, units left: " . $this->battle->getAttackingArmy()->count() . "</h2>";
        } else {
            echo "<h2>There is no one alive, sad sight </h2>";
            echo "<br /> Attacking army count: " . $this->battle->getAttackingArmy()->count();
            echo "<br /> Defending army count: " . $this->battle->getDefendingArmy()->count();
        }
    }
}
