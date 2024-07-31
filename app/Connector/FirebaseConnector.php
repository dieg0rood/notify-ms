<?php

namespace App\Connector;

use App\Interfaces\Connector\PushConnectorInterface;

class FirebaseConnector implements PushConnectorInterface
{
    protected string $deviceToken;
    protected string $subject;
    protected string $body;
    protected ?array $mobilePayload;

    public function getConnectorName(): string
    {
        return 'firebase';
    }

    public function sendNotification(
        string $deviceToken,
        string $subject,
        string $body,
        ?array $mobilePayload = null
    ): bool|string
    {
        $this->deviceToken = $deviceToken;
        $this->subject = $subject;
        $this->body = $body;
        $this->mobilePayload = $mobilePayload;

        return $this->send();
    }

    private function send(): bool|string
    {
        //TODO: implements firebase or other
        return true;
    }
}
