<?php declare(strict_types=1);

namespace BattleFight\Application\Factory;

use BattleFight\Domain\Armor\Armor;
use BattleFight\Domain\Armor\ArmorInterface;
use BattleFight\Domain\Armor\Type\ArmorTypeInterface;
use BattleFight\Domain\Armor\Type\BulletproofVestType;
use BattleFight\Domain\Exception\ArmorTypeException;

/**
 * Class ArmorFactory
 * @package BattleFight\Application\Factory
 */
class ArmorFactory
{
    /**
     * @param array $config
     *
     * @return ArmorInterface
     * @throws ArmorTypeException
     */
    public function create(array $config): ArmorInterface
    {
        $weapon = new Armor(
            $this->resolveArmorType($config['type']),
            (int)$config['attributes']['protection']
        );

        return $weapon;
    }

    /**
     * @param string $type
     *
     * @return ArmorTypeInterface
     * @throws ArmorTypeException
     */
    private function resolveArmorType(string $type): ArmorTypeInterface
    {
        switch ($type) {
            case 'bulletproofVest':
                return new BulletproofVestType();
            default:
                throw new ArmorTypeException('Unknown armor type ' . $type);
        }
    }
}
