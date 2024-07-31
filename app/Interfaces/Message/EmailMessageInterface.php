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

interface EmailMessageInterface
{
    public function getTo(): array;

    public function getAttachments(): array;

    public function getSubject(): string;

    public function getBody(): string;

    public function getBcc(): ?array;

    public function getCc(): ?array;
}
