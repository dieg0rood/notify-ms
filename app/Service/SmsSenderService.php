<?php

namespace App\Service;

use App\Interfaces\Message\SmsMessageInterface;
use App\Interfaces\Service\SmsSenderInterface;

class SmsSenderService implements SmsSenderInterface
{
    private SmsMessageInterface $message;

    public function message(SmsMessageInterface $message): SmsSenderService
    {
        $this->message = $message;

        return $this;
    }
    public function send(): bool
    {
        return true;
    }

}