<?php

namespace App\Validation\Commands;

use App\Validation\ValidationException;
use App\Validation\ValidatorCommandInterface;

class ValidateKeyExistCommand implements ValidatorCommandInterface
{
  /**
   * @var array
   */
    private array $arr;

  /**
   * @var mixed
   */
    private mixed $key;

  /**
   * @var string|null
   */
    private string|null $customErrorMessage;

  /**
   * @param array $arr
   * @param mixed $key
   * @param string|null $customErrorMessage
   */
    public function __construct(array $arr, mixed $key, ?string $customErrorMessage)
    {
        $this->arr = $arr;
        $this->key = $key;
        $this->customErrorMessage = $customErrorMessage;
    }

    /**
     * {@inheritDoc}
     */
    public function validate()
    {
        if (!array_key_exists($this->key, $this->arr)) {
            throw new ValidationException($this->customErrorMessage ?? "Key is not exist in array");
        }
    }
}
