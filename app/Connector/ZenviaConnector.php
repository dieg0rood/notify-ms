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

namespace App\Connector;

use App\Interfaces\Connector\SmsConnectorInterface;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Hyperf\Contract\StdoutLoggerInterface;

use function Hyperf\Config\config;
use function Hyperf\Support\make;

class ZenviaConnector implements SmsConnectorInterface
{
    protected string $to;

    protected string $from;

    protected string $text;

    public function getConnectorName(): string
    {
        return 'zenvia';
    }

    public function sendNotification(int|string $to, string $text): bool
    {
        $this->to = $to;
        $this->from = config('drivers.sms.zenvia.sender_id');
        $this->text = trim($text);

        if (strlen($this->text) > 160) {
            return false;
        }

        return $this->send();
    }

    private function send(): bool
    {
        $client = make(Client::class, [
            [
                'base_uri' => config('drivers.sms.zenvia.api'),
                'headers' => [
                    'X-API-TOKEN' => config('drivers.sms.zenvia.token'),
                ],
            ],
        ]);

        try {
            $client->post('/v2/channels/sms/messages', [
                'json' => [
                    'from' => config('drivers.sms.zenvia.sender_id'),
                    'to' => $this->to,
                    'contents' => [
                        [
                            'type' => 'text',
                            'text' => $this->text,
                        ],
                    ],
                ],
            ]);
        } catch (ClientException|Exception $e) {
            make(StdoutLoggerInterface::class)
                ->alert(
                    'Message: ' . $e->getMessage() .
                    "\n File: " . $e->getFile() .
                    "\n Line: " . $e->getLine() .
                    " \n TraceAsString: " . $e->getTraceAsString()
                );

            return false;
        }
        return true;
    }
}
