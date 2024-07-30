<?php

namespace App\Interfaces\Validator;

interface ValidatorInterface
{
    public function getRules(): array;
    public function getMessages(): array;
}