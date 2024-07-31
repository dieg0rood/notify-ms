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

namespace App\Interfaces\Message;

interface PushMessageInterface
{
    public function getBody(): string;

    public function getSubject(): string;

    public function getPayload(): ?string;
}
