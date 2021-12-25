<?php

namespace App\Services;

use Doctrine\ORM\EntityManager;

class BaseService
{
  /**
   * @var EntityManager $dbConn
   */
    protected EntityManager $dbConn;

    public function __construct(EntityManager $dbConn)
    {
        $this->dbConn = $dbConn;
    }
}
