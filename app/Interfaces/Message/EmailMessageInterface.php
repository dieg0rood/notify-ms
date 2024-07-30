<?php

namespace App\Interfaces\Message;

interface EmailMessageInterface
{
    /**
     * @return string
     */
    public function getTo(): string;

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
     * @return string|null
     */
    public function getBcc(): ?string;

    /**
     * @return string|null
     */
    public function getCc(): ?string;
}