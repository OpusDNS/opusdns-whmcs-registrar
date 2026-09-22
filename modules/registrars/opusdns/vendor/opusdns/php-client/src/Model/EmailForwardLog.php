<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\EmailForwardLogStatus;
use OpusDNS\Client\Serializer;

final readonly class EmailForwardLog implements ApiModel
{
    /**
     * @param \DateTimeImmutable $createdOn Timestamp when email was received by ImprovMX
     * @param string $domain Domain name
     * @param EmailForwardLogStatus|string $finalStatus Final status of the email (QUEUED, DELIVERED, REFUSED,
     *     SOFT-BOUNCE, HARD-BOUNCE)
     * @param string $forwardEmail Forward destination email address
     * @param string $hostname Hostname that received the email
     * @param string $logId Unique ID of the log from ImprovMX
     * @param string $messageId Email message ID
     * @param string $recipientEmail Recipient email address (the alias)
     * @param string $senderEmail Sender email address
     * @param string $subject Email subject
     * @param \DateTimeImmutable $syncedOn Timestamp when record was synced to ClickHouse
     * @param string $transport Transport method (mx or smtp)
     * @param list<EmailForwardLogEvent>|null $events List of processing events
     * @param string|null $forwardName Forward destination name
     * @param string|null $recipientName Recipient name
     * @param string|null $senderName Sender name
     */
    public function __construct(
        public \DateTimeImmutable $createdOn,
        public string $domain,
        public EmailForwardLogStatus|string $finalStatus,
        public string $forwardEmail,
        public string $hostname,
        public string $logId,
        public string $messageId,
        public string $recipientEmail,
        public string $senderEmail,
        public string $subject,
        public \DateTimeImmutable $syncedOn,
        public string $transport,
        public ?array $events = null,
        public ?string $forwardName = null,
        public ?string $recipientName = null,
        public ?string $senderName = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            createdOn: new \DateTimeImmutable($data['created_on']),
            domain: $data['domain'],
            finalStatus: EmailForwardLogStatus::tryFrom($data['final_status']) ?? $data['final_status'],
            forwardEmail: $data['forward_email'],
            hostname: $data['hostname'],
            logId: $data['log_id'],
            messageId: $data['message_id'],
            recipientEmail: $data['recipient_email'],
            senderEmail: $data['sender_email'],
            subject: $data['subject'],
            syncedOn: new \DateTimeImmutable($data['synced_on']),
            transport: $data['transport'],
            events: isset($data['events']) ? array_map(static fn (array $item): EmailForwardLogEvent => EmailForwardLogEvent::fromArray($item), $data['events']) : null,
            forwardName: $data['forward_name'] ?? null,
            recipientName: $data['recipient_name'] ?? null,
            senderName: $data['sender_name'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'created_on' => $this->createdOn,
            'domain' => $this->domain,
            'final_status' => $this->finalStatus,
            'forward_email' => $this->forwardEmail,
            'hostname' => $this->hostname,
            'log_id' => $this->logId,
            'message_id' => $this->messageId,
            'recipient_email' => $this->recipientEmail,
            'sender_email' => $this->senderEmail,
            'subject' => $this->subject,
            'synced_on' => $this->syncedOn,
            'transport' => $this->transport,
            'events' => $this->events,
            'forward_name' => $this->forwardName,
            'recipient_name' => $this->recipientName,
            'sender_name' => $this->senderName,
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
