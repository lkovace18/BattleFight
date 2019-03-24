<?php declare(strict_types=1);

namespace BattleFight\Test\Factory;

use BattleFight\Application\Service\ArmyGeneratorService;
use BattleFight\Domain\Armor\Armor;
use BattleFight\Domain\Armor\Type\BulletproofVestType;
use BattleFight\Domain\Army\ArmyInterface;
use BattleFight\Domain\Unit\Type\MedicType;
use BattleFight\Domain\Unit\Type\SoldierType;
use BattleFight\Domain\Weapon\Type\RifleType;
use BattleFight\Domain\Weapon\Weapon;
use PHPUnit\Framework\TestCase;


class ArmyGeneratorServiceTest extends TestCase
{
    /** @var ArmyGeneratorService */
    protected $generatorService;

    /** s@test */
    public function it_generates_army_based_on_available_pesants()
    {
        echo " Start " . memory_get_usage() . "\n";
        $availablePesants = 1000;

        $army = $this->generatorService->generate($availablePesants);

        $this->assertTrue($army instanceof ArmyInterface);
        $this->assertSame($availablePesants, $army->count());

        echo " End " . memory_get_usage() . "\n";
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
        echo memory_get_usage() . "\n"; // 57960

        return;
    }
}
