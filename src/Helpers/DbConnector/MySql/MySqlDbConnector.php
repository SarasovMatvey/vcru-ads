<?php

namespace App\Helpers\DbConnector\MySql;

use App\Dto\DoctrineConnectionConfig;
use App\Dto\MySqlConnectionConfig;
use App\Helpers\DbConnector\DbConnectorAbstract;
use JetBrains\PhpStorm\ArrayShape;

class MySqlDbConnector extends DbConnectorAbstract
{
  /**
   * @var MySqlConnectionConfig $dbConnectionConfig
   */
    protected MySqlConnectionConfig $dbConnectionConfig;

  /**
   * @var DoctrineConnectionConfig $doctrineConnectionConfig
   */
    protected DoctrineConnectionConfig $doctrineConnectionConfig;

  /**
   * @param MySqlConnectionConfig $dbConnectionConfig
   * @param DoctrineConnectionConfig $doctrineConnectionConfig
   */
    public function __construct(
        MySqlConnectionConfig $dbConnectionConfig,
        DoctrineConnectionConfig $doctrineConnectionConfig
    ) {
        $this->dbConnectionConfig = $dbConnectionConfig;
        $this->doctrineConnectionConfig = $doctrineConnectionConfig;
    }

  /**
   * {@inheritdoc}
   */
    #[ArrayShape(['driver' => "string", 'dbname' => "string", 'user' => "string", 'password' => "string", 'host' => "string"])]
    protected function getDbConnectionParams(): array
    {
        return [
          'host' => $this->dbConnectionConfig->host,
          'dbname'   => $this->dbConnectionConfig->dbName,
          'user'     => $this->dbConnectionConfig->user,
          'password' => $this->dbConnectionConfig->password,
          'driver'   => 'pdo_mysql',
        ];
    }

  /**
   * {@inheritdoc}
   */
    protected function getDoctrineConnectionConfig(): DoctrineConnectionConfig
    {
        return $this->doctrineConnectionConfig;
    }
}
