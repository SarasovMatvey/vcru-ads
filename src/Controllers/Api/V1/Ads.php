<?php

namespace App\Controllers\Api\V1;

use App\Controllers\BaseController;
use App\Dto\Api\ApiAddAdOkResponseData;
use App\Dto\Api\ApiAddAdRequest;
use App\Dto\Api\ApiCommonResponse;
use App\Dto\Api\ApiUpdateAdOkResponseData;
use App\Dto\Api\ApiUpdateAdRequest;
use App\Dto\EmptyDto;
use App\Entities\Ad;
use App\Services\AdService;
use App\Validation\ValidationException;
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
        try {
            try {
                $data = ApiAddAdRequest::fromRequest($request);
            } catch (ValidationException $e) {
                $responseDto = new ApiCommonResponse();
                $responseDto->code = 400;
                $responseDto->message = $e->getMessage();
                $responseDto->data = new EmptyDto();

                $response = new Response();
                $response->getBody()->write($responseDto->serializeJson());

                return $response;
            }

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
        } catch (Throwable) {
            $responseDto = new ApiCommonResponse();
            $responseDto->code = 500;
            $responseDto->message = "Server error";
            $responseDto->data = new EmptyDto();

            $response = new Response();
            $response->getBody()->write($responseDto->serializeJson());

            return $response;
        }
    }

  /**
   * @param ServerRequestInterface $request
   * @param array $args
   *
   * @return ResponseInterface
   */
    public function update(ServerRequestInterface $request, array $args): ResponseInterface
    {
        try {
            try {
                $data = ApiUpdateAdRequest::fromRequest($request);
            } catch (ValidationException $e) {
                $responseDto = new ApiCommonResponse();
                $responseDto->code = 400;
                $responseDto->message = $e->getMessage();
                $responseDto->data = new EmptyDto();

                $response = new Response();
                $response->getBody()->write($responseDto->serializeJson());

                return $response;
            }

            $ad = $this->dbConn->getRepository(Ad::class)->find($args['id']);

            if (!$ad) {
              $responseDto = new ApiCommonResponse();
              $responseDto->code = 400;
              $responseDto->message = "Invalid ad id";
              $responseDto->data = new EmptyDto();

              $response = new Response();
              $response->getBody()->write($responseDto->serializeJson());

              return $response;
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
        } catch (Throwable) {
            $responseDto = new ApiCommonResponse();
            $responseDto->code = 500;
            $responseDto->message = "Server error";
            $responseDto->data = new EmptyDto();

            $response = new Response();
            $response->getBody()->write($responseDto->serializeJson());

            return $response;
        }
    }

  /**
   * @param ServerRequestInterface $request
   * @return Response
   */
    public function getRelevant(ServerRequestInterface $request): Response
    {
        try {
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
        } catch (Throwable) {
            $responseDto = new ApiCommonResponse();
            $responseDto->code = 500;
            $responseDto->message = "Server error";
            $responseDto->data = new EmptyDto();

            $response = new Response();
            $response->getBody()->write($responseDto->serializeJson());

            return $response;
        }
    }
}
