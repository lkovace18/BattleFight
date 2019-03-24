<?php declare(strict_types=1);

namespace BattleFight\Test\Army;

use BattleFight\Domain\Army\Army;
use BattleFight\Domain\Unit\Type\SoldierType;
use BattleFight\Domain\Unit\Unit;
use PHPUnit\Framework\TestCase;


class ArmyTest extends TestCase
{
    /** @test */
    public function it_returns_units_count()
    {
        $armyCount = 3;

        $army = new Army();

        for ($i = 0; $i < $armyCount; $i++) {
            $army->add(new Unit(new SoldierType(), 100));
        }

        $this->assertEquals($armyCount, $army->count());
    }
}
