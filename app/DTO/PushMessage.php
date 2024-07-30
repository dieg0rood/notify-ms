<?php

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

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @return string|null
     */
    public function getPayload(): ?string
    {
        return $this->payload;
    }


}