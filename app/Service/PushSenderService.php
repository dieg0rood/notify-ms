<?php

namespace App\Service;

use App\Interfaces\Message\PushMessageInterface;
use App\Interfaces\Service\PushSenderInterface;

class PushSenderService implements PushSenderInterface
{
    private PushMessageInterface $message;

    public function message(PushMessageInterface $message): PushSenderService
    {
        $this->message = $message;

        return $this;
    }
    public function send(): bool
    {
        //TODO: implement firebase before this
        return true;
    }

}