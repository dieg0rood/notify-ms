<?php

namespace App\Factory;

use App\DTO\EmailMessage;
use App\DTO\PushMessage;
use App\DTO\SmsMessage;
use App\Enum\NotificationTypesSupported;
use App\Interfaces\Message\EmailMessageInterface;
use App\Interfaces\Message\PushMessageInterface;
use App\Interfaces\Message\SmsMessageInterface;
use function Hyperf\Support\make;

trait DtoFactory
{
    private function makeDto(string $type, $data): EmailMessageInterface | SmsMessageInterface | PushMessageInterface
    {
        return make(
            match ($type) {
                NotificationTypesSupported::Email->value    => EmailMessage::class,
                NotificationTypesSupported::Sms->value      => SmsMessage::class,
                NotificationTypesSupported::Push->value     => PushMessage::class
            }
        , $data);
    }
}