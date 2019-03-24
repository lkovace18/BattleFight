<?php declare(strict_types=1);

$debug = 'true'; // @todo uncomment $_GET['debug'] ?? false;
if ($debug && $debug === 'true') {
    define("APPLICATION_ENVIRONMENT", "debug");
}

if (defined('APPLICATION_ENVIRONMENT') === false) {
    // @todo add getenv
    define("APPLICATION_ENVIRONMENT", "development");
}

use BattleFight\Application\Service\Report\HtmlDebugReportService;
use BattleFight\Application\Service\Report\ReportService;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../bootstrap/app.php';

try {
    $attackingArmyCount = $_GET['attacker'] ?? 0;
    $defendingArmyCount = $_GET['defender'] ?? 0;

    $battle = $BattleFight->createGameFrom((int)$attackingArmyCount, (int)$defendingArmyCount);

} catch (InvalidArgumentException $exception) {
    echo "Army validation failed: " . $exception->getMessage() . "<br />";
    echo "Make sure that url have this parameters: index.php?defender=10&attacker=10";

    die();
} catch (Exception $exception) {
    echo "Application error <br />";
    if (defined('APPLICATION_ENVIRONMENT') && APPLICATION_ENVIRONMENT === 'debug') {
        echo $exception->getMessage() . " <br />";
    }

    die();
}


switch (APPLICATION_ENVIRONMENT) {
    case 'debug':
        (new HtmlDebugReportService($battle))->render();
        break;
    case 'development':
        (new ReportService($battle))->render();
        break;
    default:
        echo "Report service not defined, please check your envororment";
}
