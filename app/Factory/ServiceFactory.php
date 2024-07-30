<?php

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
                NotificationTypesSupported::Email->value    => EmailSenderService::class,
                NotificationTypesSupported::Sms->value      => SmsSenderService::class,
                NotificationTypesSupported::Push->value     => PushSenderService::class
            }
        );
    }
}