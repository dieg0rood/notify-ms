<?php

namespace App\Enum;

enum NotificationTypesSupported: string
{
    case Email = 'email';
    case Sms = 'sms';
    case Push = 'push';
    case SmokeSignal = 'smokeSignal';

}