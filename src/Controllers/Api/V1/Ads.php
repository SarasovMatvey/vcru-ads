<?php

namespace App\Controllers\Api\V1;

use App\Controllers\BaseController;
use App\Dto\ApiAddAdOkResponseData;
use App\Dto\ApiAddAdRequest as DtoApiAddAdRequest;
use App\Dto\ApiCommonResponse;
use App\Entities\Ad;
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
        $data = DtoApiAddAdRequest::fromRequest($request);

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
   * @param  ServerRequestInterface $request
   * @return void
   */
    public function update(ServerRequestInterface $request)
    {
        echo "Comming soon!";
        var_dump($request);
    }

  /**
   * @param  ServerRequestInterface $request
   * @return void
   */
    public function getRelevant(ServerRequestInterface $request)
    {
        echo "Comming soon!";
        var_dump($request);
    }
}
