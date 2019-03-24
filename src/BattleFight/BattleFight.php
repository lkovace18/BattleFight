<?php declare(strict_types=1);

namespace BattleFight;

use BattleFight\Application\Factory\ArmorFactory;
use BattleFight\Application\Factory\WeaponFactory;
use BattleFight\Application\Service\ArmyGeneratorService;
use BattleFight\Application\Service\Battle\BattleService;
use BattleFight\Application\Service\Battle\FightService;
use BattleFight\Application\Service\Battle\RoundService;
use BattleFight\Domain\Army\ArmyInterface;
use BattleFight\Domain\Battle\Battle;
use BattleFight\Domain\Battlefield\Battlefield;
use BattleFight\Domain\Modifier\Modifier;
use BattleFight\Domain\Unit\Type\MedicType;
use BattleFight\Domain\Unit\Type\SoldierType;
use InvalidArgumentException;

/**
 * Class BattleFight
 * @package BattleFight
 */
class BattleFight
{
    /** @var ArmyGeneratorService */
    private $generatorService;

    /** @var BattleService */
    private $battleService;

    /**
     * BattleFight constructor.
     */
    public function __construct()
    {
        $this->bootstrap();
    }

    private function bootstrap(): void
    {
        // @todo Add DIC later
        $this
            ->loadArmyGeneratorService()
            ->loadBattleService();
    }

    /**
     * @return BattleFight
     */
    private function loadBattleService(): BattleFight
    {
        $this->battleService = new BattleService(
            new RoundService(
                new FightService()
            )
        );

        return $this;
    }

    /**
     * @return BattleFight
     * @throws Domain\Exception\ArmorTypeException
     * @throws Domain\Exception\WeaponTypeException
     */
    private function loadArmyGeneratorService(): BattleFight
    {
        $this->generatorService = new ArmyGeneratorService(
            [
                new SoldierType(),
                new MedicType(),
            ],
            $this->loadWeapons(),
            $this->loadArmor()
        );

        return $this;
    }

    /**
     * @return array
     * @throws Domain\Exception\WeaponTypeException
     * @todo handle exceptions when we load this from config file
     */
    private function loadWeapons(): array
    {
        $weaponFactory = new WeaponFactory();

        return [
            $weaponFactory->create([
                'type' => 'rifle',
                'attributes' => [
                    'name' => 'AK-47',
                    'damage' => 30,
                ],
            ]),
            $weaponFactory->create([
                'type' => 'pistol',
                'attributes' => [
                    'name' => 'G45',
                    'damage' => 10,
                ],
            ]),
        ];
    }

    /**
     * @return array
     * @throws Domain\Exception\ArmorTypeException
     * @todo handle exceptions when we load this from config file
     */
    private function loadArmor(): array
    {
        $armorFactory = new ArmorFactory();

        return [
            $armorFactory->create([
                'type' => 'bulletproofVest',
                'attributes' => [
                    'protection' => 20,
                ],
            ]),
            $armorFactory->create([
                'type' => 'bulletproofVest',
                'attributes' => [
                    'protection' => 10,
                ],
            ]),
        ];
    }

    /**
     * @param int $attackingUnitCount
     * @param int $defendingUnitCount
     *
     * @return Battle
     */
    public function createGameFrom(int $attackingUnitCount, int $defendingUnitCount): Battle
    {
        $battle = $this->battleService->fight(
            new Battlefield(),
            $this->createRandomArmyFromSize($attackingUnitCount),
            $this->createRandomArmyFromSize($defendingUnitCount),
            new Modifier( // @todo this should be collection of modifiers
                Modifier::BATTLEFIELD_MODIFIER_TYPE,
                Modifier::HEALTH_MODIFIER,
                'tsunami',
                1000,
                3
            )
        );

        return $battle;
    }

    /**
     * @param int $unitsSize
     *
     * @return ArmyInterface
     */
    private function createRandomArmyFromSize(int $unitsSize): ArmyInterface
    {
        $unitsSize = $this->validateArmyCount($unitsSize);

        return $this->generatorService->generate($unitsSize);
    }

    /**
     * @param int $armyCount
     *
     * @return int
     * @todo  move this to service later
     */
    private function validateArmyCount(int $armyCount)
    {
        if ($armyCount <= 0) {
            throw new InvalidArgumentException('Army count cannot be less than one');
        }

        if ($armyCount >= 10000) {
            // Time: 1.32 minutes, Memory: 2.85 GB running Unit and junit for 100000
            throw new InvalidArgumentException('Army count is too high, change config if you feel confident');
        }

        return $armyCount;
    }
}
