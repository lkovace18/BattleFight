<?php declare(strict_types=1);

namespace BattleFight\Application\Factory;

use BattleFight\Domain\Exception\ModifierException;
use BattleFight\Domain\Modifier\Modifier;
use BattleFight\Domain\Modifier\ModifierInterface;

/**
 * Class ModifierFactory
 * @package BattleFight\Application\Factory
 */
class ModifierFactory
{
    /**
     * @param array $config
     *
     * @return ModifierInterface
     */
    public function create(array $config): ModifierInterface
    {
        $weapon = new Modifier(
            $this->resolveModifierType($config['type']),
            $this->resolveModifierAffectType($config['attributes']['affect_type']),
            (string)$config['attributes']['name'],
            (int)$config['attributes']['affect_value'],
            (int)$config['attributes']['chance']
        );

        return $weapon;
    }

    /**
     * @param string $type
     *
     * @return string
     * @todo add modifier types
     */
    private function resolveModifierType(string $type): string
    {
        switch ($type) {
            case Modifier::BATTLEFIELD_MODIFIER_TYPE:
                return Modifier::BATTLEFIELD_MODIFIER_TYPE;
            case Modifier::ROUND_MODIFIER_TYPE:
                return Modifier::ROUND_MODIFIER_TYPE;
            case Modifier::UNIT_MODIFIER_TYPE:
                return Modifier::UNIT_MODIFIER_TYPE;
            default:
                throw new ModifierException('Unknown modifier type ' . $type);
        }
    }

    /**
     * @param string $type
     *
     * @return string
     * @todo add modifier types
     */
    private function resolveModifierAffectType(string $type): string
    {
        switch ($type) {
            case Modifier::HEALTH_MODIFIER:
                return Modifier::HEALTH_MODIFIER;
            case Modifier::DAMAGE_MODIFIER:
                return Modifier::DAMAGE_MODIFIER;
            default:
                throw new ModifierException('Unknown modifier affect type ' . $type);
        }
    }
}
