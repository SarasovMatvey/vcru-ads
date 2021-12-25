<?php

use App\Dto\DoctrineConnectionConfig;
use App\Dto\MySqlConnectionConfig;
use App\Helpers\DbConnector\MySql\MySqlDbConnector;
use App\Routers\Api\V1\Register;
use Doctrine\ORM\EntityManager;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Route\Router;

/**
 * This is necessary to normalize routers paths. 
 * Without trimming paths will include project 
 * directory name.
 */
// TODO: remove this after Docker set up
function trimUrlPrefix()
{
  $uri = '/vcre-ads';
  $_SERVER['REQUEST_URI'] = substr($_SERVER['REQUEST_URI'], (strlen($uri)));
}

/**
 * @param EntityManager $dbConn
 * @return void
 */
function initRouters(EntityManager $dbConn)
{
  $request = ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
  );

  $router = new Router();
  $register = new Register($dbConn);

  $register->register($router);
  $response = $router->dispatch($request);
  (new SapiEmitter)->emit($response);
}


/**
 * @return EntityManager|null
 */
function getDbConnection(): ?EntityManager
{
  $mysqlConnConf = new MySqlConnectionConfig();
  $mysqlConnConf->dbName = $_ENV['DATABASE_NAME'];
  $mysqlConnConf->user = $_ENV['DATABASE_USER'];
  $mysqlConnConf->password = $_ENV['DATABASE_PASSWORD'];

  $doctrineConnConf = new DoctrineConnectionConfig();
  $doctrineConnConf->entitiesPaths = [__DIR__ . '/src/Entities'];
  $doctrineConnConf->isDevMode = (bool) $_ENV['DEV_MODE'];

  $mysqlConnector = new MySqlDbConnector($mysqlConnConf, $doctrineConnConf);

  try {
    return $mysqlConnector->getConnection($doctrineConnConf);
  } catch (Throwable $e) {
    // TODO: replace this with http response 500    
    exit(0);
  }
}
