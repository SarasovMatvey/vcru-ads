<?php

use App\Helpers\EnvExtracter\EnvExtracter;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\DependencyFactory;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/functions.php';

EnvExtracter::extract(__DIR__);
$migrationConfig = new PhpFile('migrations.php');
$dbConn = getDbConnection();
return DependencyFactory::fromEntityManager($migrationConfig, new ExistingEntityManager($dbConn));
