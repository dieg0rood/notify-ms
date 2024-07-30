<?php

namespace App\Interfaces\Service;

use App\Interfaces\Message\EmailMessageInterface;

interface EmailSenderInterface extends SenderInterface
{
    public function message(EmailMessageInterface $message): self;
}