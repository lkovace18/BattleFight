<?php

error_reporting(E_ALL | E_STRICT);

$autoloadFile = __DIR__ . '/../vendor/autoload.php';
if (file_exists($autoloadFile) === false) {
    throw new RuntimeException('Install dependencies to run phpunit.');
}

require_once $autoloadFile;
