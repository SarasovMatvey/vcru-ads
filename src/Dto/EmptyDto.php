<?php

namespace App\Dto;

class EmptyDto extends DtoAbstract
{
    public function getAsArray(): array
    {
        return [];
    }
}
