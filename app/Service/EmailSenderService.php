<?php

namespace App\Service;

use App\Interfaces\Message\EmailMessageInterface;
use App\Interfaces\Service\EmailSenderInterface;

class EmailSenderService implements EmailSenderInterface
{
    private EmailMessageInterface $message;

    public function message(EmailMessageInterface $message): EmailSenderService
    {
        $this->message = $message;

        return $this;
    }

    public function send(): bool
    {
        return true;
    }

}