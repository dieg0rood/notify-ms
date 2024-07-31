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

namespace App\Factory;

use App\Enum\NotificationTypesSupported;
use App\Interfaces\Service\SenderInterface;
use App\Service\EmailSenderService;
use App\Service\PushSenderService;
use App\Service\SmsSenderService;

use function Hyperf\Support\make;

trait ServiceFactory
{
    private function makeService(string $type): SenderInterface
    {
        return make(
            match ($type) {
                NotificationTypesSupported::Email->value => EmailSenderService::class,
                NotificationTypesSupported::Sms->value => SmsSenderService::class,
                NotificationTypesSupported::Push->value => PushSenderService::class
            }
        );
    }
}
