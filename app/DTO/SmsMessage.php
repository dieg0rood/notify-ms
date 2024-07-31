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

namespace App\DTO;

use App\Interfaces\Message\SmsMessageInterface;

class SmsMessage implements SmsMessageInterface
{
    private string $cellphone;

    private string $body;

    public function __construct(array $data)
    {
        $this->cellphone = $data['mobile']['cellphone'];
        $this->body = $data['mobile']['sms']['body'];
    }

    public function getCellphone(): string
    {
        return $this->cellphone;
    }

    public function getBody(): string
    {
        return $this->body;
    }
}
