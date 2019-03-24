<?php declare(strict_types=1);

namespace BattleFight\Application\Service;

use BattleFight\Domain\Armor\ArmorInterface;
use BattleFight\Domain\Army\Army;
use BattleFight\Domain\Army\ArmyInterface;
use BattleFight\Domain\Unit\Type\UnitTypeInterface;
use BattleFight\Domain\Unit\Unit;
use BattleFight\Domain\Weapon\WeaponInterface;

/**
 * Class ArmyGeneratorService
 * @package BattleFight\Application\Service
 */
class ArmyGeneratorService
{
    /** @var array */
    private $unitTypeCollection;

    /** @var array */
    private $waeponTypeCollection;

    /** @var array */
    private $armorTypeCollection;

    public function __construct(
        array $unitTypeCollection,
        array $weaponTypeCollection,
        array $armorTypeCollection
    ) {
        $this->unitTypeCollection = $unitTypeCollection;
        $this->waeponTypeCollection = $weaponTypeCollection;
        $this->armorTypeCollection = $armorTypeCollection;
    }

    /**
     * @param int $availableUnits
     *
     * @return ArmyInterface
     */
    public function generate(int $availableUnits): ArmyInterface
    {
        $army = new Army();

        for ($i = 0; $i < $availableUnits; $i++) {

            $unitBaseDamage = rand(5, 10);
            $unitBaseHealth = rand(90, 100);
            $unit = new Unit(
                $this->getRandomUnitType(),
                $unitBaseHealth,
                $unitBaseDamage
            );

            $unit->equipWeapon($this->getRandomWeapon());

            if ($this->calculateChance(50)) {
                $unit->equipArmor($this->getRandomArmor());
            }

            $army->add($unit);
            unset($unit);
        }

        return $army;
    }

    /**
     * @return UnitTypeInterface
     */
    private function getRandomUnitType(): UnitTypeInterface
    {
        return $this->unitTypeCollection[array_rand($this->unitTypeCollection)];
    }

    /**
     * @return WeaponInterface
     */
    private function getRandomWeapon(): WeaponInterface
    {
        return $this->waeponTypeCollection[array_rand($this->waeponTypeCollection)];
    }

    /**
     * @param int $percent
     *
     * @return bool
     * @todo Move this to service and load $percent from config
     */
    private function calculateChance(int $percent): bool
    {
        return mt_rand(0, 99) < $percent;
    }

    /**
     * @return ArmorInterface
     */
    private function getRandomArmor(): ArmorInterface
    {
        return $this->armorTypeCollection[array_rand($this->armorTypeCollection)];
    }
}
