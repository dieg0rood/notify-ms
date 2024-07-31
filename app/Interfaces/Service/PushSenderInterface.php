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

namespace App\Interfaces\Service;

use App\Interfaces\Message\PushMessageInterface;

interface PushSenderInterface extends SenderInterface
{
    public function message(PushMessageInterface $message): self;
}
