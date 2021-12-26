<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/functions.php';

use App\Helpers\EnvExtracter\EnvExtracter;

EnvExtracter::extract(__DIR__);
$dbConn = getDbConnection();
initRouters($dbConn);
