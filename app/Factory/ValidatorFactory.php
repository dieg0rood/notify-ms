<?php

namespace App\Factory;

use App\Enum\NotificationTypesSupported;
use App\Interfaces\Validator\ValidatorInterface;
use App\Validator\EmailMessageValidator;
use App\Validator\PushMessageValidator;
use App\Validator\SmsMessageValidator;
use function Hyperf\Support\make;

trait ValidatorFactory
{
    private function makeValidator(string $type): ValidatorInterface
    {
        return make(
            match ($type) {
                NotificationTypesSupported::Email->value    => EmailMessageValidator::class,
                NotificationTypesSupported::Sms->value      => SmsMessageValidator::class,
                NotificationTypesSupported::Push->value     => PushMessageValidator::class
            }
        );
    }
}