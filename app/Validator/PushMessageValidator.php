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

class PushMessageValidator extends AbstractValidator implements ValidatorInterface
{
    public function getRules(): array
    {
        return [
            'mobile.subject' => ['string', 'required'],
            'mobile.push.body' => ['string', 'required'],
            'mobile.push.payload' => ['array'],
        ];
    }

    public function getMessages(): array
    {
        return [
            'mobile.push.body.required' => 'The :attribute field is required.',
            'mobile.push.body.string' => 'The :attribute must be a string.',
            'mobile.push.payload.array' => 'The :attribute must be an array.',
            'mobile.subject.required' => 'The :attribute field is required.',
            'mobile.subject.string' => 'The :attribute must be a string.',
        ];
    }
}
