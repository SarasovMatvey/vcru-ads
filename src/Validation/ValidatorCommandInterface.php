<?php

namespace App\Validation;

interface ValidatorCommandInterface
{
  /**
   * @return void
   *
   * @throws ValidationException
   */
    public function validate();
}
