<?php

namespace App\Dto\Api;

use App\Dto\DtoAbstract;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @see Ads::update() Use inside Ads controller.
 */
class ApiUpdateAdOkResponseData extends DtoAbstract
{
  /**
   * @var int $id
   */
    public int $id;

  /**
   * @var string $text
   */
    public string $text;

  /**
   * @var string $banner
   */
    public string $banner;

  /**
   * {@inheritdoc}
   */
    #[ArrayShape(['id' => "int", 'text' => "string", 'banner' => "string"])]
    public function getAsArray(): array
    {
        return [
          'id' => $this->id,
          'text' => $this->text,
          'banner' => $this->banner,
        ];
    }
}
