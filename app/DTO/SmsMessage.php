<?php

namespace App\DTO;

use App\Interfaces\Message\SmsMessageInterface;

class SmsMessage implements SmsMessageInterface
{
    private string $cellphone;
    private string $body;

    public function __construct(array $data)
    {
        $this->cellphone = $data['mobile']['cellphone'];
        $this->body = $data['mobile']['sms']['body'];
    }

    /**
     * @return string
     */
    public function getCellphone(): string
    {
        return $this->cellphone;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

}