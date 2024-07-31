<?php

namespace App\Interfaces\Connector;

interface SmsConnectorInterface
{
    public function sendNotification(
        string|int $to,
        string $text
    ): bool;
    public function getConnectorName(): string;
}