<?php

namespace App\Dto;

use JetBrains\PhpStorm\ArrayShape;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @see Ads::update() Use inside Ads controller.
 */
class ApiUpdateAdRequest extends DtoAbstract
{
  /**
   * @var string $text
   */
    public string $text;

  /**
   * @var int $price
   */
    public int $price;

  /**
   * @var int $limit
   */
    public int $limit;

  /**
   * @var string $banner
   */
    public string $banner;

  /**
   * Populate dto from request.
   *
   * @param  ServerRequestInterface $request
   * @return ApiUpdateAdRequest
   */
    public static function fromRequest(ServerRequestInterface $request): ApiUpdateAdRequest
    {
        $data = $request->getParsedBody();

        $ApiUpdateAdRequest = new ApiUpdateAdRequest();
        $ApiUpdateAdRequest->text = $data['text'];
        $ApiUpdateAdRequest->price = $data['price'];
        $ApiUpdateAdRequest->limit = $data['limit'];
        $ApiUpdateAdRequest->banner = $data['text'];

        return $ApiUpdateAdRequest;
    }

  /**
   * {@inheritdoc}
   */
    #[ArrayShape(['text' => "string", 'price' => "int", 'limit' => "int", 'banner' => "string"])]
    public function getAsArray(): array
    {
        return [
        'text' => $this->text,
        'price' => $this->price,
        'limit' => $this->limit,
        'banner' => $this->banner,
        ];
    }
}
