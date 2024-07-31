<?php

namespace App\Interfaces\Connector;

interface PushConnectorInterface
{
    public function sendNotification(
        string $deviceToken,
        string $subject,
        string $body,
        ?array $mobilePayload = null
    ): bool|string;
    public function getConnectorName(): string;
}