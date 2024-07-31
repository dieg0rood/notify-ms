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
