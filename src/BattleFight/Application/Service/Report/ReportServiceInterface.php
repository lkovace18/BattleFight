<?php declare(strict_types=1);

namespace BattleFight\Application\Service\Report;

use BattleFight\Domain\Battle\Battle;

/**
 * Interface ReportServiceInterface
 * @package BattleFight\Application\Service\Report
 */
interface ReportServiceInterface
{
    public function __construct(Battle $battle);
}
