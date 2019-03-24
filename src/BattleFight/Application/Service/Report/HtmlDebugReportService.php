<?php declare(strict_types=1);

namespace BattleFight\Application\Service\Report;

use BattleFight\Domain\Battle\Battle;
use BattleFight\Domain\Battle\Fight\Fight;
use BattleFight\Domain\Battle\Round\Round;

/**
 * Class HtmlDebugReportService
 * @package BattleFight\Application\Service\Report
 *
 * @todo remove this
 */
class HtmlDebugReportService
{
    /** @var Battle */
    private $battle;

    /**
     * HtmlDebugReportService constructor.
     *
     * @param Battle $battle
     */
    public function __construct(Battle $battle)
    {
        $this->battle = $battle;
    }

    public function render(): void
    {
        $rounds = $this->battle->getRounds()->toArray();

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

        echo "<h3>Attacking Units deployed: " . $this->battle->getDetails()->getAttackerDeployedUnits() . "</h3>";
        echo "<h3>Defending Units deployed: " . $this->battle->getDetails()->getDefenderDeployedUnits() . "</h3>";
        echo "<h3>Total rounds: " . $this->battle->getDetails()->getRoundsCount() . "</h3>";

        /**
         * @var string $key
         * @var Round $round
         */
        foreach ($rounds as $roundKey => $round) {
            $roundNumber = $round->getDetails()->getRoundNumber();
            echo "<hr />";
            echo "<h4>Round: $roundNumber ($roundKey) </h4>";
            echo "<p>Attacking Units deployed: " . $round->getDetails()->getAttackerArmyCount() . "</p>";
            echo "<p>Defending Units deployed: " . $round->getDetails()->getDefenderArmyCount() . "</p>";


            $fights = $round->getFights()->toArray();
            $fightCounter = 0;

            /**
             * @var string $fightKey
             * @var Fight $fight
             */
            foreach ($fights as $fightKey => $fight) {
                ++$fightCounter;

                $details = $fight->getDetails();

                echo "<br /> ********************************************************** <br />";
                echo "  Fight: $fightCounter ($fightKey) <br /> <br />";

                echo "Attacker start fight with " . $details->getAttackerHealth() . " health <br />";
                echo "Attacker start fight with " . $details->getAttackerDamage() . " damage <br /> <br />";

                echo "Defender " . $fight->getDefender()->getType() . " <br />";
                echo $fight->getDefender()->getWeapon()->getType() . " " . $fight->getDefender()->getWeapon()->getName() . " <br />";
                if($fight->getDefender()->getArmor() !== null) {
                    echo $fight->getDefender()->getArmor()->getType()  . " <br />";
                }
                echo "Defender start fight with " . $details->getDefenderHealth() . " health <br />";
                echo "Defender start fight with " . $details->getDefenderDamage() . " damage <br /> <br />";

                if ($details->getAttackerHealth() - $details->getDefenderDamageDealt() <= 0) {
                    echo "Defender bravely slain attacker with last hit dealing " . $details->getDefenderDamageDealt() . " damage <br /><br />";
                } elseif ($details->getDefenderHealth() - $details->getAttackerDamageDealt() <= 0) {
                    echo "Attacker conquer defender dealing " . $details->getAttackerDamageDealt() . " damage <br /> <br />";
                }
            }
        }
    }
}
