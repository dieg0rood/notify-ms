<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

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

    public function getTo(): array
    {
        return $this->to;
    }

    public function getAttachments(): array
    {
        return $this->attachments;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getBcc(): array
    {
        return $this->bcc;
    }

    public function getCc(): array
    {
        return $this->cc;
    }
}
