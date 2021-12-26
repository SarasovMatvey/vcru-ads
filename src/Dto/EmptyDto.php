<?php

namespace App\Dto;

/**
 * You just need to return an empty object when serializing
 * to avoid getting out of the general DTO style
 */
class EmptyDto extends DtoAbstract
{
  /**
   * @return array
   */
    public function getAsArray(): array
    {
        return [];
    }
}
