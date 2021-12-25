<?php

namespace App\Dto;

use JetBrains\PhpStorm\ArrayShape;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @see Ads::add() Use inside Ads controller.
 */
class ApiAddAdRequest extends DtoAbstract
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
   * @return ApiAddAdRequest
   */
    public static function fromRequest(ServerRequestInterface $request): ApiAddAdRequest
    {
        $data = $request->getParsedBody();

        $ApiAddAdRequest = new ApiAddAdRequest();
        $ApiAddAdRequest->text = $data['text'];
        $ApiAddAdRequest->price = $data['price'];
        $ApiAddAdRequest->limit = $data['limit'];
        $ApiAddAdRequest->banner = $data['text'];

        return $ApiAddAdRequest;
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
