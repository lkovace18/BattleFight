<?php declare(strict_types=1);

namespace BattleFight\Domain\Weapon\Type;

/**
 * Class GrenadeLauncherType
 * @package BattleFight\Domain\Weapon\Type
 */
class GrenadeLauncherType implements WeaponTypeInterface, SplashDamageInterface
{
    private const RANGE = 'long';

    /** @var bool */
    private $hasSplashDamage = false;

    /** @var int */
    private $splashDamageRange = 0;

    /**
     * GrenadeLauncherType constructor.
     *
     * @param int $splashDamageRange
     */
    public function __construct(int $splashDamageRange)
    {
        $this->splashDamageRange = $splashDamageRange;

        if ($this->splashDamageRange > 0) {
            $this->hasSplashDamage = true;
        }
    }

    /**
     * @return string
     */
    public function getRange(): string
    {
        return self::RANGE;
    }

    /**
     * @return int
     */
    public function getSplashDamageRange(): int
    {
        return $this->splashDamageRange;
    }

    /**
     * @return bool
     */
    public function hasSplashDamage(): bool
    {
        return $this->hasSplashDamage;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return self::class;
    }
}
