<?php declare(strict_types=1);

namespace BattleFight\Test\Service\Battle;

use BattleFight\Application\Factory\UnitFactory;
use BattleFight\Application\Service\ArmyGeneratorService;
use BattleFight\Application\Service\Battle\FightService;
use BattleFight\Domain\Battle\Fight\Fight;
use BattleFight\Domain\Unit\UnitInterface;
use PHPUnit\Framework\TestCase;


class FightServiceTest extends TestCase
{
    /** @var ArmyGeneratorService */
    protected $generatorService;

    /** @test */
    public function it_calculates_battle_outcome()
    {
        $defendingUnit = $this->createUnit(100, 20);
        $attackingUnit = $this->createUnit(100, 40);

        $fight = (new FightService())
            ->resolve($attackingUnit, $defendingUnit);

        $this->assertTrue($fight instanceof Fight);
        $this->assertSame(60, $fight->getDefender()->getHealth());
        $this->assertSame(80, $fight->getAttacker()->getHealth());
    }

    /**
     * @param int $health
     * @param int $damage
     *
     * @return UnitInterface
     * @throws \BattleFight\Domain\Exception\UnitTypeException
     */
    private function createUnit(int $health, int $damage): UnitInterface
    {
        return (new UnitFactory)
            ->create([
                'type' => 'solider',
                'attributes' => [
                    'health' => $health,
                    'damage' => $damage,
                ],
            ]);
    }
}
