<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/functions.php';

use App\Helpers\EnvExtracter\EnvExtracter;

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

EnvExtracter::extract(__DIR__);

trimUrlPrefix();
$dbConn = getDbConnection();
initRouters($dbConn);
