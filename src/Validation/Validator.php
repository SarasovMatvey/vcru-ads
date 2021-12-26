<?php

namespace App\Validation;

class Validator
{
  /**
   * @var array<ValidatorCommandInterface>
   */
    protected array $validatorCommands;

  /**
   * @param ValidatorCommandInterface $command
   * @return void
   */
    public function addValidatorCommand(ValidatorCommandInterface $command)
    {
        $this->validatorCommands[] = $command;
    }

  /**
   * @throws ValidationException
   *
   * @return void
   */
    public function validateAll()
    {
        foreach ($this->validatorCommands as $command) {
            $command->validate();
        }
    }

  /**
   * @throws ValidationException
   *
   * @return void
   */
    public function validate(ValidatorCommandInterface $command)
    {
        $command->validate();
    }
}
