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

namespace App\Service;

use App\Interfaces\Connector\EmailConnectorInterface;
use App\Interfaces\Message\EmailMessageInterface;
use App\Interfaces\Service\EmailSenderInterface;
use Exception;
use Hyperf\Contract\StdoutLoggerInterface;

use function Hyperf\Support\make;

class EmailSenderService implements EmailSenderInterface
{
    private EmailMessageInterface $message;

    public function __construct(private readonly EmailConnectorInterface $connector)
    {
    }

    public function message(EmailMessageInterface $message): EmailSenderService
    {
        $this->message = $message;

        return $this;
    }

    public function send(): bool
    {
        try {
            $this->connector->sendNotification(
                $this->message->getTo(),
                $this->message->getSubject(),
                $this->message->getBody(),
                $this->message->getCc(),
                $this->message->getBcc(),
                $this->message->getAttachments()
            );
        } catch (Exception $e) {
            make(StdoutLoggerInterface::class)
                ->alert(
                    'Error: Notification_not_send' .
                    "\n Message: " . $e->getMessage() .
                    "\n File: " . $e->getFile() .
                    "\n Line: " . $e->getLine() . "
                    \n TraceAsString: " . $e->getTraceAsString()
                );

            return false;
        }

        return true;
    }
}
