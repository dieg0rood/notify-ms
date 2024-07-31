<?php

namespace App\Service;

use App\Interfaces\Connector\SmsConnectorInterface;
use App\Interfaces\Message\SmsMessageInterface;
use App\Interfaces\Service\SmsSenderInterface;
use Exception;
use Hyperf\Contract\StdoutLoggerInterface;
use function Hyperf\Support\make;

class SmsSenderService implements SmsSenderInterface
{
    private SmsMessageInterface $message;

    public function __construct(private readonly SmsConnectorInterface $connector)
    {
    }

    public function message(SmsMessageInterface $message): SmsSenderService
    {
        $this->message = $message;

        return $this;
    }
    public function send(): bool
    {
        try {
            $this->connector->sendNotification(
                to: $this->message->getCellphone(),
                text: $this->message->getBody()
            );
        } catch (Exception $e) {
            make(StdoutLoggerInterface::class)
                ->alert(
                    "\nMessage: " . $e->getMessage() .
                    "\n File: " . $e->getFile() .
                    "\n Line: " . $e->getLine() . "
                    \n TraceAsString: " . $e->getTraceAsString());

            return false;
        }

        return true;
    }

}