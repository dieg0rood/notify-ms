<?php

namespace App\Interfaces\Service;

interface SenderInterface
{
    public function send(): bool;
}