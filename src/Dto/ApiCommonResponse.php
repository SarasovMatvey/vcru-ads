<?php

namespace App\Dto;

use JetBrains\PhpStorm\ArrayShape;

class ApiCommonResponse extends DtoAbstract
{
  /**
   * @var string $message
   */
    public string $message;

  /**
   * @var int $code
   */
    public int $code;

  /**
   * @var DtoAbstract $data
   */
    public DtoAbstract $data;

  /**
   * {@inheritdoc}
   */
    #[ArrayShape(['message' => "string", 'code' => "int", 'data' => "array"])]
    public function getAsArray(): array
    {
        return [
        'message' => $this->message,
        'code' => $this->code,
        'data' => $this->data->getAsArray(),
        ];
    }
}
