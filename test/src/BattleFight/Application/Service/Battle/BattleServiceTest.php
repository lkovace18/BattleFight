<?php declare(strict_types=1);

namespace BattleFight\Test\Service\Battle;

use BattleFight\Application\Service\ArmyGeneratorService;
use BattleFight\Application\Service\Battle\BattleService;
use BattleFight\Application\Service\Battle\FightService;
use BattleFight\Application\Service\Battle\RoundService;
use BattleFight\Domain\Armor\Armor;
use BattleFight\Domain\Armor\Type\BulletproofVestType;
use BattleFight\Domain\Battle\Battle;
use BattleFight\Domain\Battlefield\Battlefield;
use BattleFight\Domain\Modifier\Modifier;
use BattleFight\Domain\Unit\Type\MedicType;
use BattleFight\Domain\Unit\Type\SoldierType;
use BattleFight\Domain\Weapon\Type\RifleType;
use BattleFight\Domain\Weapon\Weapon;
use PHPUnit\Framework\TestCase;


class BattleServiceTest extends TestCase
{
    /** @var ArmyGeneratorService */
    protected $generatorService;

    /** s@test */
    public function it_returns_finished_battle()
    {
        $attackingArmy = $this->generatorService->generate(20);
        $defendingArmy = $this->generatorService->generate(20);

        $battleService = new BattleService(
            new RoundService(
                new FightService()
            )
        );

        $battle = $battleService->fight(
            new Battlefield(),
            $attackingArmy,
            $defendingArmy,
            new Modifier(
                Modifier::BATTLEFIELD_MODIFIER_TYPE,
                Modifier::HEALTH_MODIFIER,
                'tsunami',
                1000,
                3
            )
        );

        $this->assertTrue($battle instanceof Battle);
        $this->assertTrue($battle->isFinished() === true);
        $this->assertTrue($battle->getRounds()->count() > 0);
    }

    protected function setUp(): void
    {
        $this->generatorService = new ArmyGeneratorService(
            [
                new SoldierType(),
                new MedicType(),
            ],
            [
                new Weapon(new RifleType(), 'Dummy AK-47', 10),
            ],
            [
                new Armor(new BulletproofVestType(), 30),
            ]
        );

        return;
    }
}
