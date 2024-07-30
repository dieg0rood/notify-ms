<?php

namespace App\DTO;

use App\Interfaces\Message\EmailMessageInterface;

class EmailMessage implements EmailMessageInterface
{
    private string $to;
    private ?string $cc;
    private ?string $bcc;
    private string $body;
    private string $subject;
    private array $attachments = [];

    public function __construct(array $data)
    {
        $this->to = $data['email']['to'];
        $this->cc = $data['email']['cc'] ?? null;
        $this->bcc = $data['email']['bcc'] ?? null;
        $this->body = $data['email']['body'];
        $this->subject = $data['email']['subject'];
        $this->attachments = $data['email']['attachments'] ?? [];
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * @return array
     */
    public function getAttachments(): array
    {
        return $this->attachments;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @return string|null
     */
    public function getBcc(): ?string
    {
        return $this->bcc;
    }

    /**
     * @return string|null
     */
    public function getCc(): ?string
    {
        return $this->cc;
    }


}