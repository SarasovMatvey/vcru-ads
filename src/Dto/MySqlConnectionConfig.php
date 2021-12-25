<?php

namespace App\Dto;

use JetBrains\PhpStorm\ArrayShape;

class MySqlConnectionConfig extends DtoAbstract
{
  /**
   * @var string $dbName
   */
    public string $dbName;

  /**
   * @var string $user
   */
    public string $user;

  /**
   * @var string $password
   */
    public string $password;

  /**
   * {@inheritdoc}
   */
    #[ArrayShape(['db_name' => "string", 'user' => "string", 'password' => "string"])]
    public function getAsArray(): array
    {
        return [
        'db_name' => $this->dbName,
        'user' => $this->user,
        'password' => $this->password,
        ];
    }
}
