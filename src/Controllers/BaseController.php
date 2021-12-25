<?php

namespace App\Controllers;

use Doctrine\ORM\EntityManager;

class BaseController
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
