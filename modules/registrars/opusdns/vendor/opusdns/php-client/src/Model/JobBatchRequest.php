<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Serializer;
use OpusDNS\Client\Union;

final readonly class JobBatchRequest implements ApiModel
{
    /**
     * @param list<DomainCreateCommand|DomainUpdateCommand|DomainTransferCommand|DnsZoneCreateCommand|DnsZoneUpdateCommand|DomainCreateBulkCommand|DomainTransferBulkCommand|DomainUpdateBulkCommand|DnsZoneCreateBulkCommand|DnsZoneUpdateBulkCommand|DnsZonePatchRrsetsBulkCommand|DnsZonePatchRecordsBulkCommand|DnsZoneRestampVanityNsBulkCommand|ContactCreateBulkCommand|ContactCreateCommand|ParkingCreateBulkCommand|ParkingEnableBulkCommand|ParkingDisableBulkCommand|ParkingDeleteBulkCommand|EmailForwardCreateBulkCommand|EmailForwardEnableBulkCommand|EmailForwardDisableBulkCommand|EmailForwardDeleteBulkCommand|EmailForwardUpdateBulkCommand|DomainForwardCreateBulkCommand|DomainForwardUpdateBulkCommand|DomainForwardEnableBulkCommand|DomainForwardDisableBulkCommand|DomainForwardDeleteBulkCommand> $commands List of commands to execute
     * @param string|null $label Human-readable label for this batch
     * @param \DateTimeImmutable|null $notBefore Earliest time jobs can execute (UTC). If not provided, jobs run
     *     immediately.
     * @param bool $paused If true, jobs are created in paused state and must be explicitly resumed
     */
    public function __construct(
        public array $commands,
        public ?string $label = null,
        public ?\DateTimeImmutable $notBefore = null,
        public bool $paused = false,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            commands: array_map(static fn (array $item) => Union::discriminate($item, 'command', [
                'contact_create' => ContactCreateCommand::class,
                'contact_create_bulk' => ContactCreateBulkCommand::class,
                'dns_zone_create' => DnsZoneCreateCommand::class,
                'dns_zone_create_bulk' => DnsZoneCreateBulkCommand::class,
                'dns_zone_patch_records_bulk' => DnsZonePatchRecordsBulkCommand::class,
                'dns_zone_patch_rrsets_bulk' => DnsZonePatchRrsetsBulkCommand::class,
                'dns_zone_restamp_vanity_ns_bulk' => DnsZoneRestampVanityNsBulkCommand::class,
                'dns_zone_update' => DnsZoneUpdateCommand::class,
                'dns_zone_update_bulk' => DnsZoneUpdateBulkCommand::class,
                'domain_create' => DomainCreateCommand::class,
                'domain_create_bulk' => DomainCreateBulkCommand::class,
                'domain_forward_create_bulk' => DomainForwardCreateBulkCommand::class,
                'domain_forward_delete_bulk' => DomainForwardDeleteBulkCommand::class,
                'domain_forward_disable_bulk' => DomainForwardDisableBulkCommand::class,
                'domain_forward_enable_bulk' => DomainForwardEnableBulkCommand::class,
                'domain_forward_update_bulk' => DomainForwardUpdateBulkCommand::class,
                'domain_transfer' => DomainTransferCommand::class,
                'domain_transfer_bulk' => DomainTransferBulkCommand::class,
                'domain_update' => DomainUpdateCommand::class,
                'domain_update_bulk' => DomainUpdateBulkCommand::class,
                'email_forward_create_bulk' => EmailForwardCreateBulkCommand::class,
                'email_forward_delete_bulk' => EmailForwardDeleteBulkCommand::class,
                'email_forward_disable_bulk' => EmailForwardDisableBulkCommand::class,
                'email_forward_enable_bulk' => EmailForwardEnableBulkCommand::class,
                'email_forward_update_bulk' => EmailForwardUpdateBulkCommand::class,
                'parking_create_bulk' => ParkingCreateBulkCommand::class,
                'parking_delete_bulk' => ParkingDeleteBulkCommand::class,
                'parking_disable_bulk' => ParkingDisableBulkCommand::class,
                'parking_enable_bulk' => ParkingEnableBulkCommand::class,
            ]), $data['commands']),
            label: $data['label'] ?? null,
            notBefore: isset($data['not_before']) ? new \DateTimeImmutable($data['not_before']) : null,
            paused: $data['paused'] ?? false,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'commands' => $this->commands,
            'label' => $this->label,
            'not_before' => $this->notBefore,
            'paused' => $this->paused,
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
