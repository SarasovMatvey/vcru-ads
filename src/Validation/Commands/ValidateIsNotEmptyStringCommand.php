<?php

namespace App\Validation\Commands;

use App\Validation\ValidationException;
use App\Validation\ValidatorCommandInterface;

class ValidateIsNotEmptyStringCommand implements ValidatorCommandInterface
{
  /**
   * @var mixed
   */
    private mixed $checkedString;

  /**
   * @var string|null
   */
    private string|null $customErrorMessage;

  /**
   * @param mixed $checkedString
   * @param string|null $customErrorMessage
   */
    public function __construct(mixed $checkedString, ?string $customErrorMessage)
    {
        $this->checkedString = $checkedString;
        $this->customErrorMessage = $customErrorMessage;
    }

    /**
     * {@inheritDoc}
     */
    public function validate()
    {
        if ($this->checkedString === "") {
            throw new ValidationException($this->customErrorMessage ?? "Checked string is empty");
        }
    }
}
