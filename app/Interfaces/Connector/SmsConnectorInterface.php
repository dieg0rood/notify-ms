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

interface SmsConnectorInterface
{
    public function sendNotification(
        int|string $to,
        string $text
    ): bool;

    public function getConnectorName(): string;
}
