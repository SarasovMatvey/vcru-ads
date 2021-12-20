<?php

use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

require_once "vendor/autoload.php";

$migrationConfig = new PhpFile('migrations.php');

$paths = [__DIR__ . "/src/Entities"];
$isDevMode = false;

// the connection configuration
$dbParams = [
  'driver'   => 'pdo_mysql',
  'user'     => 'root',
  'password' => 'qwe123R1',
  'dbname'   => 'vcruads',
];

$ORMconfig = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $ORMconfig);

return DependencyFactory::fromEntityManager($migrationConfig, new ExistingEntityManager($entityManager));
