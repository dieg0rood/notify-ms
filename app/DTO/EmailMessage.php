<?php

namespace App\DTO;

use App\Interfaces\Message\EmailMessageInterface;

class EmailMessage implements EmailMessageInterface
{
    private array $to;
    private array $cc;
    private array $bcc;
    private string $body;
    private string $subject;
    private array $attachments = [];

    public function __construct(array $data)
    {
        $this->to = $data['email']['to'];
        $this->cc = $data['email']['cc'] ?? [];
        $this->bcc = $data['email']['bcc'] ?? [];
        $this->body = $data['email']['body'];
        $this->subject = $data['email']['subject'];
        $this->attachments = $data['email']['attachments'] ?? [];
    }

    /**
     * @return array
     */
    public function getTo(): array
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
     * @return array
     */
    public function getBcc(): array
    {
        return $this->bcc;
    }

    /**
     * @return array
     */
    public function getCc(): array
    {
        return $this->cc;
    }


}