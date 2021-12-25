<?php

namespace App\Helpers\EnvExtracter;

use Dotenv\Dotenv;

class EnvExtracter
{
  /**
   * Make variables from .env file accessible from all php project
   *
   * Exmple:
   * ``` php
   * $_ENV['DB_PASSWORD']
   * ```
   *
   * @param  string $envFileDirectory - directory where .env file stored (tipically it's root of project)
   * @return void
   */
    public static function extract(string $envFileDirectory)
    {
        $dotenv = Dotenv::createImmutable($envFileDirectory);
        $dotenv->load();
    }
}
