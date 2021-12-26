<?php

namespace App\Dto;

use Exception;

abstract class DtoAbstract
{
  /**
   * Dto array necessary for json serialization.
   *
   * @return array<string, mixed>
   */
    abstract public function getAsArray(): array;

  /**
   * @return string
   *
   * @throws Exception
   */
    public function serializeJson(): string
    {
        $json = json_encode($this->getAsArray(), JSON_FORCE_OBJECT);

        if (is_string($json)) {
            return $json;
        } else {
            throw new Exception('Fail to parse json');
        }
    }
}
