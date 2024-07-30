<?php

namespace App\Interfaces\Service;

use App\Interfaces\Message\SmsMessageInterface;

interface SmsSenderInterface extends SenderInterface
{
    public function message(SmsMessageInterface $message): self;
}