<?php

namespace App\Validation\Commands;

use App\Validation\ValidationException;
use App\Validation\ValidatorCommandInterface;

class ValidateIsSetCommand implements ValidatorCommandInterface
{
    private mixed $checkedVar;
    private string|null $customErrorMessage;

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
        if (!isset($this->checkedVar)) {
            throw new ValidationException($this->customErrorMessage ?? "Checked variable is not set");
        }
    }
}
