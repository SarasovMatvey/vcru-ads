<?php

namespace App\Validation\Commands;

use App\Validation\ValidationException;
use App\Validation\ValidatorCommandInterface;

/**
 * Check given url is valid
 */
class ValidateUrlCommand implements ValidatorCommandInterface
{
  /**
   * @var string
   */
    private string $url;

  /**
   * @var string|null
   */
    private string|null $customErrorMessage;

  /**
   * @param string $url
   * @param string|null $customErrorMessage
   */
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
