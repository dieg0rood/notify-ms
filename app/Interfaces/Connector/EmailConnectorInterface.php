<?php

namespace App\Interfaces\Connector;

interface EmailConnectorInterface
{
    public function sendNotification(
        array $emailsTo,
        string $subject,
        string $body,
        array $emailsCc = [],
        array $emailsBcc = [],
        array $attachments = []
    ): bool;
    public function getConnectorName(): string;
}