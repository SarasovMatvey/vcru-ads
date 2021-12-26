<?php

namespace App\Validation\Commands;

use App\Validation\ValidationException;
use App\Validation\ValidatorCommandInterface;

class ValidateIsStringCommand implements ValidatorCommandInterface
{
  /**
   * @var mixed
   */
    private mixed $checkedVar;

  /**
   * @var string|null
   */
    private string|null $customErrorMessage;

  /**
   * @param mixed $checkedVar
   * @param string|null $customErrorMessage
   */
    public function __construct(mixed $checkedVar, ?string $customErrorMessage)
    {
        $this->checkedVar = $checkedVar;
        $this->customErrorMessage = $customErrorMessage;
    }

    /**
     * {@inheritDoc}
     */
    public function validate()
    {
        if (!is_string($this->checkedVar)) {
            throw new ValidationException($this->customErrorMessage ?? "Checked variable is not string");
        }
    }
}
