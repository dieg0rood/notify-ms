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

namespace App\Validator;

use App\Interfaces\Validator\ValidatorInterface;

class SmsMessageValidator extends AbstractValidator implements ValidatorInterface
{
    public function getRules(): array
    {
        return [
            'mobile.cellphone' => ['string', 'required'],
            'mobile.sms.body' => ['string', 'required'],
            'mobile.subject' => ['string', 'required'],
        ];
    }

    public function getMessages(): array
    {
        return [
            'mobile.cellphone.required' => 'The :attribute field is required.',
            'mobile.cellphone.string' => 'The :attribute must be a string.',
            'mobile.sms.body.required' => 'The :attribute field is required.',
            'mobile.sms.body.string' => 'The :attribute must be a string.',
            'mobile.subject.required' => 'The :attribute field is required.',
            'mobile.subject.string' => 'The :attribute must be a string.',
        ];
    }
}
