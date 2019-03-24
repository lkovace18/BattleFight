<?php declare(strict_types=1);

namespace BattleFight\Application\Service\Utility;


/**
 * Class ChanceService
 * @package BattleFight\Application\Service\Utility
 */
class ChanceService
{
    /**
     * @param int $percent
     *
     * @return bool
     */
    public function __invoke(int $percent): bool
    {
        return mt_rand(0, 99) < $percent;
    }
}
