<?php

namespace App\Validation;

class Validator
{
  /**
   * @var array<ValidatorCommandInterface>
   */
    protected array $validatorCommands;

    public function addValidatorCommand(ValidatorCommandInterface $command)
    {
        $this->validatorCommands[] = $command;
    }

  /**
   * @throws ValidationException
   */
    public function validateAll()
    {
        foreach ($this->validatorCommands as $command) {
            $command->validate();
        }
    }

  /**
   * @throws ValidationException
   */
    public function validate(ValidatorCommandInterface $command)
    {
        $command->validate();
    }
}
