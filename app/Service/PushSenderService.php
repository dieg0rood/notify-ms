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

namespace App\Service;

use App\Interfaces\Message\PushMessageInterface;
use App\Interfaces\Service\PushSenderInterface;

class PushSenderService implements PushSenderInterface
{
    private PushMessageInterface $message;

    public function message(PushMessageInterface $message): PushSenderService
    {
        $this->message = $message;

        return $this;
    }

    public function send(): bool
    {
        // TODO: implement firebase before this
        return true;
    }
}
