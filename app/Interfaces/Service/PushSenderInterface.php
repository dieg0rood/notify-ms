<?php

namespace App\Interfaces\Service;

use App\Interfaces\Message\PushMessageInterface;

interface PushSenderInterface extends SenderInterface
{
    public function message(PushMessageInterface $message): self;
}