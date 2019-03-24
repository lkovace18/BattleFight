<?php declare(strict_types=1);

namespace BattleFight\Domain\Weapon;

use BattleFight\Domain\Exception\WeaponValidationException;
use BattleFight\Domain\Weapon\Type\WeaponTypeInterface;

/**
 * Class Weapon
 * @package BattleFight\Domain\Weapon
 */
class Weapon implements WeaponInterface
{
    /** @var WeaponTypeInterface */
    private $type;

    /** @var int */
    private $damage;

    /** @var string */
    private $name;

    /**
     * Weapon constructor.
     *
     * @param WeaponTypeInterface $type
     * @param string $name
     * @param int $damage
     *
     * @throws WeaponValidationException
     */
    public function __construct(WeaponTypeInterface $type, string $name, int $damage)
    {
        $this->type = $type;
        $this->damage = $damage;
        $this->name = trim($name);

        if ($damage < 0 || $damage > 100) {
            throw new WeaponValidationException('Weapon damage must be in range 0 - 100');
        }

        if ($name !== '' && strlen($name) <= 2) {
            throw new WeaponValidationException('Weapon name must be longer than 2 characters');
        }
    }

    /**
     * @return int
     */
    public function getDamage(): int
    {
        return $this->damage;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return WeaponTypeInterface
     */
    public function getType(): WeaponTypeInterface
    {
        return $this->type;
    }
}
