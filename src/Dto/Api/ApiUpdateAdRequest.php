<?php

namespace App\Dto\Api;

use App\Dto\DtoAbstract;
use App\Validation\Commands\ValidateIsIntCommand;
use App\Validation\Commands\ValidateIsNotZeroCommand;
use App\Validation\Commands\ValidateIsNotEmptyStringCommand;
use App\Validation\Commands\ValidateIsSetCommand;
use App\Validation\Commands\ValidateIsStringCommand;
use App\Validation\Commands\ValidateIsUnsignedCommand;
use App\Validation\Commands\ValidateKeyExistCommand;
use App\Validation\Commands\ValidateUrlCommand;
use App\Validation\ValidationException;
use App\Validation\Validator;
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
   * @param ServerRequestInterface $request
   * @return ApiUpdateAdRequest
   *
   * @throws ValidationException
   */
    public static function fromRequest(ServerRequestInterface $request): ApiUpdateAdRequest
    {
        self::validate($request);


        $data = $request->getParsedBody();

        $ApiUpdateAdRequest = new ApiUpdateAdRequest();
        $ApiUpdateAdRequest->text = $data['text'];
        $ApiUpdateAdRequest->price = $data['price'];
        $ApiUpdateAdRequest->limit = $data['limit'];
        $ApiUpdateAdRequest->banner = $data['banner'];

        return $ApiUpdateAdRequest;
    }

  /**
   * @param ServerRequestInterface $request
   * @return void
   *
   * @throws ValidationException
   */
    private static function validate(ServerRequestInterface $request)
    {
        $validator = new Validator();

        $data = $request->getParsedBody();

        $validator->validate(new ValidateKeyExistCommand($data, 'text', 'Parameter is not set: text'));
        $validator->validate(new ValidateIsSetCommand($data['text'], 'Parameter is not set: text'));
        $validator->validate(new ValidateIsStringCommand($data['text'], 'Parameter must be string: text'));
        $validator->validate(new ValidateIsNotEmptyStringCommand($data['text'], 'Text must not be empty'));
        $validator->validate(new ValidateKeyExistCommand($data, 'price', 'Parameter is not set: price'));
        $validator->validate(new ValidateIsSetCommand($data['price'], 'Parameter is not set: price'));
        $validator->validate(new ValidateIsIntCommand($data['price'], 'Parameter must be integer: price'));
        $validator->validate(new ValidateIsUnsignedCommand($data['price'], 'Price must be unsigned'));
        $validator->validate(new ValidateIsNotZeroCommand($data['price'], 'Price cannot be zero'));
        $validator->validate(new ValidateKeyExistCommand($data, 'limit', 'Parameter is not set: limit'));
        $validator->validate(new ValidateIsSetCommand($data['limit'], 'Parameter is not set: limit'));
        $validator->validate(new ValidateIsIntCommand($data['limit'], 'Parameter must be integer: limit'));
        $validator->validate(new ValidateIsUnsignedCommand($data['limit'], 'Limit must be unsigned'));
        $validator->validate(new ValidateIsNotZeroCommand($data['limit'], 'Limit cannot be zero'));
        $validator->validate(new ValidateKeyExistCommand($data, 'banner', 'Parameter is not set: banner'));
        $validator->validate(new ValidateIsSetCommand($data['banner'], 'Parameter is not set: banner'));
        $validator->validate(new ValidateUrlCommand($data['banner'], 'Invalid banner link'));
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
