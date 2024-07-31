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
