<?php

namespace App\Validator;

use App\Interfaces\Validator\ValidatorInterface;

class EmailMessageValidator extends AbstractValidator implements ValidatorInterface
{
    public function getRules(): array
    {
        return [
            'email.to' => 'array',
            'email.to.*' => ['email', 'required'],
            'email.cc' => 'array',
            'email.cc.*' => 'email',
            'email.bcc' => 'array',
            'email.bcc.*' => 'email',
            'email.subject' => ['string', 'required'],
            'email.body' => ['string', 'required'],
            'email.attachments' => ['array'],
            'email.attachments.*.realName' => ['required', 'string'],
            'email.attachments.*.path' => ['required','string'],
        ];
    }

    public function getMessages(): array
    {
        return [
            'email.to.*.required' => 'The :attribute field is required.',
            'email.to.*.email' => 'The :attribute must be a valid email address.',
            'email.cc.*.email' => 'The :attribute must be a valid email address.',
            'email.bcc.*.email' => 'The :attribute must be a valid email address.',
            'email.attachments.*.realName.required' => 'The :attribute field is required.',
            'email.attachments.*.path.required' => 'The :attribute field is required.',
        ];
    }
}