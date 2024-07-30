<?php

declare(strict_types=1);

namespace App\Amqp\Consumer;

use App\Enum\NotificationTypesSupported;
use App\Factory\DtoFactory;
use App\Factory\ServiceFactory;
use App\Factory\ValidatorFactory;
use App\Interfaces\Service\SenderInterface;
use App\Interfaces\Validator\ValidatorInterface;
use App\Service\EmailSenderService;
use App\Service\PushSenderService;
use App\Service\SmsSenderService;
use App\Validator\EmailMessageValidator;
use App\Validator\PushMessageValidator;
use App\Validator\SmsMessageValidator;
use Egulias\EmailValidator\EmailValidator;
use Hyperf\Amqp\Result;
use Hyperf\Amqp\Annotation\Consumer;
use Hyperf\Amqp\Message\ConsumerMessage;
use Hyperf\Coroutine\Parallel;
use PhpAmqpLib\Message\AMQPMessage;
use function Hyperf\Support\make;

#[Consumer(
    exchange:   'Notification',
    routingKey: 'NotificationConsumer',
    queue:      'NotificationConsumer',
    name:       "NotificationConsumer",
    nums: 1
)]
class NotificationConsumer extends ConsumerMessage
{
    use ServiceFactory, ValidatorFactory, DtoFactory;
    public function consumeMessage($data, AMQPMessage $message): Result
    {
        $parallel = new Parallel();

        foreach($data['types'] as $type) {

            $validator = $this->makeValidator($type);
            $service = $this->makeService($type);
            $messageDto = $this->makeDto($type, $data);

            if ($validator->validate($data)) {
                $parallel->add(function () use ($service, $messageDto){
                    $service->message($messageDto)->send();
                });
            }
        }

        $parallel->wait();

        return Result::ACK;
    }
}
