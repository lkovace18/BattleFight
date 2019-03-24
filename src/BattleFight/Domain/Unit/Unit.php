<?php declare(strict_types=1);

namespace BattleFight\Domain\Unit;

use BattleFight\Domain\Armor\ArmorInterface;
use BattleFight\Domain\Exception\UnitValidationException;
use BattleFight\Domain\Unit\Type\UnitTypeInterface;
use BattleFight\Domain\Utility\Traits\UuidTrait;
use BattleFight\Domain\Weapon\WeaponInterface;

/**
 * Class Unit
 * @package BattleFight\Domain\Unit
 */
class Unit implements UnitInterface
{
    use UuidTrait;

    /** @var int */
    private $health;

    /** @var int */
    private $damage;

    /** @var UnitTypeInterface */
    private $type;

    /** @var WeaponInterface */
    private $weapon;

    /** @var ArmorInterface */
    private $armor;

    /**
     * Unit constructor.
     *
     * @param UnitTypeInterface $type
     * @param int $health
     * @param int $damage
     */
    public function __construct(UnitTypeInterface $type, int $health, int $damage = 10)
    {
        $this->uuid = $this->generateUuid();

        $this->health = $health;
        $this->type = $type;
        $this->damage = $damage;

        if ($health < 0 || $health > 100) {
            throw new UnitValidationException('Unti health must be in range 0 - 100');
        }
    }

    /**
     * @return int
     */
    public function getHealth(): int
    {
        return $this->health;
    }

    /**
     * @param int $damage
     *
     * @return UnitInterface
     */
    public function reduceHealth(int $damage): UnitInterface
    {
        $this->health -= $damage;

        return $this;
    }

    /**
     * @return int
     */
    public function getDamage(): int
    {
        return $this->damage;
    }

    /**
     * @return UnitTypeInterface
     */
    public function getType(): UnitTypeInterface
    {
        return $this->type;
    }

    /**
     * @param WeaponInterface $weapon
     *
     * @return UnitInterface
     */
    public function equipWeapon(WeaponInterface $weapon): UnitInterface
    {
        $this->weapon = $weapon;
        $this->damage +=  $weapon->getDamage();

        return $this;
    }

    /**
     * @param ArmorInterface $armor
     *
     * @return UnitInterface
     */
    public function equipArmor(ArmorInterface $armor): UnitInterface
    {
        $this->armor = $armor;
        $this->health +=  $armor->getProtection();

        return $this;
    }

    /**
     * @return WeaponInterface
     */
    public function getWeapon(): WeaponInterface
    {
        return $this->weapon;
    }

    /**
     * @return ArmorInterface
     */
    public function getArmor(): ?ArmorInterface
    {
        return $this->armor;
    }
}
