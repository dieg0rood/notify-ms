<?php

namespace App\Interfaces\Message;

interface EmailMessageInterface
{
    /**
     * @return array
     */
    public function getTo(): array;

    /**
     * @return array
     */
    public function getAttachments(): array;

    /**
     * @return string
     */
    public function getSubject(): string;

    /**
     * @return string
     */
    public function getBody(): string;

    /**
     * @return array|null
     */
    public function getBcc(): ?array;

    /**
     * @return array|null
     */
    public function getCc(): ?array;
}