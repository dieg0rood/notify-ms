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

namespace App\Amqp\Consumer;

use App\Factory\DtoFactory;
use App\Factory\ServiceFactory;
use App\Factory\ValidatorFactory;
use Hyperf\Amqp\Annotation\Consumer;
use Hyperf\Amqp\Message\ConsumerMessage;
use Hyperf\Amqp\Result;
use Hyperf\Coroutine\Parallel;
use PhpAmqpLib\Message\AMQPMessage;

#[Consumer(
    exchange: 'Notification',
    routingKey: 'NotificationConsumer',
    queue: 'NotificationConsumer',
    name: 'NotificationConsumer',
    nums: 1
)]
class NotificationConsumer extends ConsumerMessage
{
    use ServiceFactory;
    use ValidatorFactory;
    use DtoFactory;

    public function consumeMessage($data, AMQPMessage $message): Result
    {
        $parallel = new Parallel();

        foreach ($data['types'] as $type) {
            $validator = $this->makeValidator($type);
            $service = $this->makeService($type);
            $messageDto = $this->makeDto($type, $data);

            if ($validator->validate($data)) {
                $parallel->add(function () use ($service, $messageDto) {
                    $service->message($messageDto)->send();
                });
            }
        }

        $parallel->wait();

        return Result::ACK;
    }
}
