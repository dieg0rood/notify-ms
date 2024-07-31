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

use App\Interfaces\Message\PushMessageInterface;

class PushMessage implements PushMessageInterface
{
    private string $body;

    private ?string $payload;

    private string $subject;

    public function __construct(array $data)
    {
        $this->subject = $data['mobile']['subject'];
        $this->body = $data['mobile']['push']['body'];
        $this->payload = $data['mobile']['push']['payload'];
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getPayload(): ?string
    {
        return $this->payload;
    }
}
