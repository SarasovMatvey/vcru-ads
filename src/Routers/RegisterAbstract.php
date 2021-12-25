<?php

namespace App\Routers;

use Doctrine\ORM\EntityManager;
use League\Route\Router;

abstract class RegisterAbstract
{
    protected EntityManager $dbConn;

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
