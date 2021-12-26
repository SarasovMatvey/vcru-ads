<?php

namespace App\Routers;

use Doctrine\ORM\EntityManager;
use League\Route\Router;

abstract class RegisterAbstract
{
  /**
   * @var EntityManager
   */
    protected EntityManager $dbConn;

  /**
   * @param EntityManager $dbConn
   */
    public function __construct(EntityManager $dbConn)
    {
        $this->dbConn = $dbConn;
    }

  /**
   * Attach routes with controllers to $router.
   *
   * @param  Router $router
   * @return void
   */
    abstract public function register(Router $router);
}
