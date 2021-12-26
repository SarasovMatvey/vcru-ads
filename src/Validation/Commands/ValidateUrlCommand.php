<?php

namespace App\Validation\Commands;

use App\Validation\ValidationException;
use App\Validation\ValidatorCommandInterface;

class ValidateUrlCommand implements ValidatorCommandInterface
{
    private string $url;
    private string|null $customErrorMessage;

    public function __construct(string $url, ?string $customErrorMessage)
    {
        $this->url = $url;
        $this->customErrorMessage = $customErrorMessage;
    }

    /**
     * {@inheritDoc}
     */
    public function validate()
    {
        if (!filter_var($this->url, FILTER_VALIDATE_URL)) {
            throw new ValidationException($this->customErrorMessage ?? "Invalid url");
        }
    }
}
