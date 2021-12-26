<?php

namespace App\Validation\Commands;

use App\Validation\ValidationException;
use App\Validation\ValidatorCommandInterface;

class ValidateIsUnsignedCommand implements ValidatorCommandInterface
{
    private mixed $checkedInt;
    private string|null $customErrorMessage;

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
        if ($this->checkedInt < 0) {
            throw new ValidationException($this->customErrorMessage ?? "Checked int is not unsigned");
        }
    }
}
