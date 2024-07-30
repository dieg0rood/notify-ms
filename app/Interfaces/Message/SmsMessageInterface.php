<?php

namespace App\Interfaces\Message;

interface SmsMessageInterface
{
    /**
     * @return string
     */
    public function getCellphone(): string;

    /**
     * @return string
     */
    public function getBody(): string;

    /**
     * @return string
     */
    public function getSubject(): string;
}