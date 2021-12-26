<?php

namespace App\Validation\Commands;

use App\Validation\ValidationException;
use App\Validation\ValidatorCommandInterface;

class ValidateIsNotZeroCommand implements ValidatorCommandInterface
{
  /**
   * @var mixed|int
   */
    private mixed $checkedInt;

  /**
   * @var string|null
   */
    private string|null $customErrorMessage;

  /**
   * @param int $checkedInt
   * @param string|null $customErrorMessage
   */
    public function __construct(int $checkedInt, ?string $customErrorMessage)
    {
        $this->checkedInt = $checkedInt;
        $this->customErrorMessage = $customErrorMessage;
    }

    /**
     * {@inheritDoc}
     */
    public function validate()
    {
        if ($this->checkedInt === 0) {
            throw new ValidationException($this->customErrorMessage ?? "Checked int equal zero");
        }
    }
}
