<?php

namespace App\Helpers\DbConnector;

use App\Dto\DoctrineConnectionConfig;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Setup;

abstract class DbConnectorAbstract
{
  /**
   * @return array<string, mixed>
   */
    abstract protected function getDbConnectionParams(): array;

  /**
   * @return DoctrineConnectionConfig
   */
    abstract protected function getDoctrineConnectionConfig(): DoctrineConnectionConfig;

  /**
   * Template method pattern to provide for variable databases types (e.g. MySql, Postgres, Oracle).
   *
   * @return EntityManager
   *
   * @throws ORMException
   */
    final public function getConnection(): EntityManager
    {
        $ORMconfig = Setup::createAnnotationMetadataConfiguration(
            $this->getDoctrineConnectionConfig()->entitiesPaths,
            $this->getDoctrineConnectionConfig()->isDevMode,
        );

        return EntityManager::create($this->getDbConnectionParams(), $ORMconfig);
    }
}
