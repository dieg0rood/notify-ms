<?php

namespace App\Interfaces\Message;

interface PushMessageInterface
{
    /**
     * @return string
     */
    public function getBody(): string;

    /**
     * @return string
     */
    public function getSubject(): string;

    /**
     * @return string|null
     */
    public function getPayload(): ?string;
}