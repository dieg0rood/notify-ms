<?php

namespace App\Validator;

use App\Interfaces\Validator\ValidatorInterface;

class PushMessageValidator extends AbstractValidator implements ValidatorInterface
{
    public function getRules(): array
    {
        return [];
    }
    public function getMessages(): array
    {
        return [];
    }
}