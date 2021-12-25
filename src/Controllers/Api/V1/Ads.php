<?php

namespace App\Controllers\Api\V1;

use App\Controllers\BaseController;
use App\Dto\ApiAddAdOkResponseData;
use App\Dto\ApiAddAdRequest;
use App\Dto\ApiCommonResponse;
use App\Dto\ApiUpdateAdOkResponseData;
use App\Dto\ApiUpdateAdRequest;
use App\Entities\Ad;
use App\Services\AdService;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;

class Ads extends BaseController
{
  /**
   * @param ServerRequestInterface $request
   * @return ResponseInterface
   */
    public function add(ServerRequestInterface $request): ResponseInterface
    {
        $data = ApiAddAdRequest::fromRequest($request);

        $ad = new Ad();
        $ad->setText($data->text);
        $ad->setPrice($data->price);
        $ad->setLimit($data->limit);
        $ad->setBanner($data->banner);

        $this->dbConn->persist($ad);
        $this->dbConn->flush();

        $responseDtoData = new ApiAddAdOkResponseData();
        $responseDtoData->id = $ad->getId();
        $responseDtoData->text = $ad->getText();
        $responseDtoData->banner = $ad->getBanner();

        $responseDto = new ApiCommonResponse();
        $responseDto->code = 200;
        $responseDto->message = "OK";
        $responseDto->data = $responseDtoData;

        $response = new Response();
        $response->getBody()->write($responseDto->serializeJson());

        return $response;
    }

  /**
   * @param ServerRequestInterface $request
   * @param array $args
   *
   * @return ResponseInterface
   */
    public function update(ServerRequestInterface $request, array $args): ResponseInterface
    {
        $data = ApiUpdateAdRequest::fromRequest($request);

        $ad = $this->dbConn->getRepository(Ad::class)->find($args['id']);

        if (!$ad) {
            // TODO: replace this with error http response
            exit(0);
        }

        $ad->setText($data->text);
        $ad->setPrice($data->price);
        $ad->setLimit($data->limit);
        $ad->setBanner($data->banner);

        $this->dbConn->flush();

        $responseDtoData = new ApiUpdateAdOkResponseData();
        $responseDtoData->id = $ad->getId();
        $responseDtoData->text = $ad->getText();
        $responseDtoData->banner = $ad->getBanner();

        $responseDto = new ApiCommonResponse();
        $responseDto->code = 200;
        $responseDto->message = "OK";
        $responseDto->data = $responseDtoData;

        $response = new Response();
        $response->getBody()->write($responseDto->serializeJson());

        return $response;
    }

  /**
   * @param ServerRequestInterface $request
   * @return Response
   */
    public function getRelevant(ServerRequestInterface $request): Response
    {
        $adService = new AdService($this->dbConn);

        $ad = $adService->getRelevant();

        $ad->setShows($ad->getShows() + 1);
        $this->dbConn->flush();

        $responseDtoData = new ApiUpdateAdOkResponseData();
        $responseDtoData->id = $ad->getId();
        $responseDtoData->text = $ad->getText();
        $responseDtoData->banner = $ad->getBanner();

        $responseDto = new ApiCommonResponse();
        $responseDto->code = 200;
        $responseDto->message = "OK";
        $responseDto->data = $responseDtoData;

        $response = new Response();
        $response->getBody()->write($responseDto->serializeJson());

        return $response;
    }
}
