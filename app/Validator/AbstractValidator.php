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

use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Validation\Contract\ValidatorFactoryInterface;

use function Hyperf\Support\make;

abstract class AbstractValidator
{
    private ValidatorFactoryInterface $validationFactory;

    private array $rules;

    private array $messages;

    public function __construct()
    {
        $this->validationFactory = make(ValidatorFactoryInterface::class);
        $this->rules = $this->getRules();
        $this->messages = $this->getMessages();
    }

    abstract public function getRules(): array;

    abstract public function getMessages(): array;

    public function validate(array $data): bool
    {
        $validator = $this->validationFactory->make(
            $data,
            $this->rules,
            $this->messages
        );

        if ($validator->fails()) {
            make(StdoutLoggerInterface::class)->error('Validation Error');
            make(StdoutLoggerInterface::class)->error(json_encode($validator->errors()->all()));
        }

        return $validator->passes();
    }
}
