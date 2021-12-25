<?php

namespace App\Dto;

use JetBrains\PhpStorm\ArrayShape;

class DoctrineConnectionConfig extends DtoAbstract
{
  /**
   * @var bool $isDevMode
   */
    public bool $isDevMode;

  /**
   * @var array $entitiesPaths
   */
    public array $entitiesPaths;

  /**
   * {@inheritdoc}
   */
    #[ArrayShape(['is_dev_mode' => "bool", 'entities_paths' => "array"])]
    public function getAsArray(): array
    {
        return [
        'is_dev_mode' => $this->isDevMode,
        'entities_paths' => $this->entitiesPaths,
        ];
    }
}
