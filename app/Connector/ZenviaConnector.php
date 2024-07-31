<?php

namespace App\Connector;


use App\Interfaces\Connector\SmsConnectorInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Hyperf\Contract\StdoutLoggerInterface;
use function Hyperf\Config\config;
use function Hyperf\Support\make;

class ZenviaConnector implements SmsConnectorInterface
{
    /**
     * @var string
     */
    protected string $to;

    /**
     * @var string
     */
    protected string $from;

    /**
     * @var string
     */
    protected string $text;

    public function getConnectorName(): string
    {
        return 'zenvia';
    }

    /**
     * @param string|int $to
     * @param string $text
     * @return void
     */
    public function sendNotification(string|int $to, string $text): bool
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
                    'X-API-TOKEN' => config('drivers.sms.zenvia.token')
                ]
            ]
        ]);

        try {
            $client->post('/v2/channels/sms/messages', [
                'json' => [
                    'from' => config('drivers.sms.zenvia.sender_id'),
                    'to' => $this->to,
                    'contents' => [
                        [
                            'type' => 'text',
                            'text' => $this->text
                        ]
                    ]
                ]
            ]);
        } catch (\Exception|ClientException $e) {
            make(StdoutLoggerInterface::class)
                ->alert("Message: " . $e->getMessage() .
                    "\n File: " . $e->getFile() .
                    "\n Line: " . $e->getLine() .
                    " \n TraceAsString: " . $e->getTraceAsString()
                );

            return false;
        }
        return true;
    }
}
