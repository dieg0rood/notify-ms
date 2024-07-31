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

use App\Interfaces\Connector\EmailConnectorInterface;
use Exception;
use GuzzleHttp\Client;
use Hyperf\Contract\StdoutLoggerInterface;
use League\Flysystem\Filesystem;

use function Hyperf\Config\config;
use function Hyperf\Support\make;

class MailgunConnector implements EmailConnectorInterface
{
    public mixed $response;

    protected string $apiKey;

    protected string $domain;

    protected string $mailFrom;

    protected string $mailFromName;

    protected array $emailsTo;

    protected array $emailsCc;

    protected array $emailsBcc;

    protected string $subject;

    protected string $body;

    private string $endpoint;

    private int $maxRetries;

    private bool $hasAttachment;

    private array $attachments;

    public function __construct()
    {
        $this->apiKey = config('drivers.email.mailgun.apiKey');
        $this->domain = config('drivers.email.mailgun.domain');

        $this->mailFrom = config('drivers.email.mailgun.mailFrom');
        $this->mailFromName = config('drivers.email.mailgun.mailFromName');
        $this->endpoint = config('drivers.email.mailgun.endpoint');
        $this->maxRetries = config('drivers.email.mailgun.maxRetries');
    }

    public function getConnectorName(): string
    {
        return 'mailgun';
    }

    public function sendNotification(
        array $emailsTo,
        string $subject,
        string $body,
        array $emailsCc = [],
        array $emailsBcc = [],
        array $attachments = []
    ): bool {
        $this->emailsTo = $emailsTo;
        $this->subject = $subject;
        $this->body = $body;
        $this->emailsCc = $emailsCc;
        $this->emailsBcc = $emailsBcc;
        $this->attachments = $attachments;
        $this->hasAttachment = ! empty($this->attachments);

        return $this->send();
    }

    public function removeFilesFromBucket(): void
    {
        if ($this->hasAttachment) {
            $filesystem = make(Filesystem::class);
            foreach ($this->attachments as $file) {
                $exists = $filesystem->fileExists($file['path']);

                if ($exists) {
                    $filesystem->delete($file['path']);
                } else {
                    make(StdoutLoggerInterface::class)
                        ->error(
                            'Attachment not found for delete: ' .
                            'path: ' . $file['path'] . ' - ' .
                            'realName: ' . $file['realName'] . ' - ' .
                            'emailsTo: ' . implode(',', $this->emailsTo) . ' - ' .
                            'subject: ' . $this->subject
                        );
                }
            }
        }
    }

    private function send(): bool
    {
        $client = make(Client::class);

        $retryCount = 0;
        $maxRetries = $this->maxRetries;

        while ($retryCount < $maxRetries) {
            try {
                $data = [
                    'auth' => ['api', $this->apiKey],
                    'multipart' => [
                        [
                            'name' => 'from',
                            'contents' => $this->mailFromName . ' <' . $this->mailFrom . '>',
                        ],
                        [
                            'name' => 'to',
                            'contents' => implode(',', $this->emailsTo),
                        ],
                        [
                            'name' => 'cc',
                            'contents' => implode(',', $this->emailsCc),
                        ],
                        [
                            'name' => 'bcc',
                            'contents' => implode(',', $this->emailsBcc),
                        ],
                        [
                            'name' => 'subject',
                            'contents' => $this->subject,
                        ],
                        [
                            'name' => 'html',
                            'contents' => $this->body,
                        ],
                    ],
                ];
                $data = $this->addFilesToData($data);
                $this->response = $client->request(
                    'POST',
                    $this->endpoint . $this->domain . '/messages',
                    $data
                );

                $this->removeFilesFromBucket();
                break;
            } catch (Exception $e) {
                ++$retryCount;
                if ($retryCount >= $maxRetries) {
                    make(StdoutLoggerInterface::class)
                        ->alert(
                            'Message: ' . $e->getMessage() .
                            "\n File: " . $e->getFile() .
                            "\n Line: " . $e->getLine() .
                            " \n TraceAsString: " . $e->getTraceAsString()
                        );
                    throw $e;
                }
            }
        }
        return true;
    }

    private function addFilesToData(array $data): array
    {
        if ($this->hasAttachment) {
            $filesystem = make(Filesystem::class);

            foreach ($this->attachments as $file) {
                $exists = $filesystem->fileExists($file['path']);

                if ($exists) {
                    $attachment = $filesystem->read($file['path']);

                    $data['multipart'][] = [
                        'name' => 'attachment',
                        'contents' => $attachment,
                        'filename' => $file['realName'],
                    ];
                } else {
                    make(StdoutLoggerInterface::class)
                        ->error(
                            'Attachment not found: ' .
                            'path: ' . $file['path'] . ' - ' .
                            'realName: ' . $file['realName'] . ' - ' .
                            'emailsTo: ' . implode(',', $this->emailsTo) . ' - ' .
                            'subject: ' . $this->subject
                        );
                }
            }
        }

        return $data;
    }
}
