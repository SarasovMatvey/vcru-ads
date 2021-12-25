<?php

namespace App\Routers\Api\V1;

use App\Controllers\Api\V1\Ads;
use App\Routers\RegisterAbstract;
use League\Route\Router;

class Register extends RegisterAbstract
{
  /**
   * {@inheritdoc}
   */
    public function register(Router $router)
    {
        $adsController = new Ads($this->dbConn);

        $router->map('POST', '/ads', [$adsController, 'add']);
        $router->map('POST', '/ads/{id}', [$adsController, 'update']);
        $router->map('GET', '/ads/relevant', [$adsController, 'getRelevant']);
    }
}
