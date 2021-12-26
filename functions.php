<?php

use App\Dto\Api\ApiCommonResponse;
use App\Dto\DoctrineConnectionConfig;
use App\Dto\EmptyDto;
use App\Dto\MySqlConnectionConfig;
use App\Helpers\DbConnector\MySql\MySqlDbConnector;
use App\Routers\Api\V1\Register;
use Doctrine\ORM\EntityManager;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Route\Http\Exception\NotFoundException;
use League\Route\Router;

/**
 * @param EntityManager $dbConn
 * @return Response|null
 */
function initRouters(EntityManager $dbConn): Response|null
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

  try {
    $response = $router->dispatch($request);
  } catch (Throwable $e) {
    $responseDto = new ApiCommonResponse();
    $responseDto->code = 400;
    $responseDto->message = "Route is not exist";
    $responseDto->data = new EmptyDto();

    $response = new Response();
    $response->getBody()->write($responseDto->serializeJson());

    (new SapiEmitter)->emit($response);
    exit(0);
  }

  (new SapiEmitter)->emit($response);
  
  return null;
}


/**
 * @return EntityManager
 */
function getDbConnection(): EntityManager
{
  $mysqlConnConf = new MySqlConnectionConfig();
  $mysqlConnConf->dbName = $_ENV['DATABASE_NAME'];
  $mysqlConnConf->user = $_ENV['DATABASE_USER'];
  $mysqlConnConf->password = $_ENV['DATABASE_PASSWORD'];
  $mysqlConnConf->host = $_ENV['DATABASE_HOST'];

  $doctrineConnConf = new DoctrineConnectionConfig();
  $doctrineConnConf->entitiesPaths = [__DIR__ . '/src/Entities'];
  $doctrineConnConf->isDevMode = (bool) $_ENV['DEV_MODE'];

  $mysqlConnector = new MySqlDbConnector($mysqlConnConf, $doctrineConnConf);

  try {
    return $mysqlConnector->getConnection();
  } catch (Throwable $e) {
    $responseDto = new ApiCommonResponse();
    $responseDto->code = 500;
    $responseDto->message = "Server error";
    $responseDto->data = new EmptyDto();

    $response = new Response();
    $response->getBody()->write($responseDto->serializeJson());

    (new SapiEmitter)->emit($response);
    exit(0);
  }
}
