<?php declare(strict_types=1);

namespace BattleFight\Application\Factory;

use BattleFight\Domain\Exception\WeaponTypeException;
use BattleFight\Domain\Weapon\Type\PistolType;
use BattleFight\Domain\Weapon\Type\RifleType;
use BattleFight\Domain\Weapon\Type\WeaponTypeInterface;
use BattleFight\Domain\Weapon\Weapon;
use BattleFight\Domain\Weapon\WeaponInterface;

/**
 * Class WeaponFactory
 * @package BattleFight\Application\Factory
 */
class WeaponFactory
{
    /**
     * @param array $config
     *
     * @return WeaponInterface
     * @throws WeaponTypeException
     */
    public function create(array $config): WeaponInterface
    {
        $weapon = new Weapon(
            $this->resolveWeaponType($config['type']),
            (string)$config['attributes']['name'],
            (int)$config['attributes']['damage']
        );

        return $weapon;
    }

    /**
     * @param string $type
     *
     * @return WeaponTypeInterface
     * @throws WeaponTypeException
     */
    private function resolveWeaponType(string $type): WeaponTypeInterface
    {
        switch ($type) {
            case 'rifle':
                return new RifleType();
            case 'pistol':
                return new PistolType();
            default:
                throw new WeaponTypeException('Unknown weapon type ' . $type);
        }
    }
}
