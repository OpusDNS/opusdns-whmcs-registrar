<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Model;

use OpusDNS\Client\ApiModel;
use OpusDNS\Client\Enum\WhitelabelRenewalMode;
use OpusDNS\Client\Serializer;

/**
 * The whitelabel's billing-lifecycle state, grouped into its own block: the parent's `subscription` is
 * null when the config has no live subscription (still provisioning, or terminated). A cancelled
 * whitelabel reads as renewal_mode=expire with expires_on set to when serving stops.
 */
final readonly class WhitelabelSubscriptionInfo implements ApiModel
{
    /**
     * @param Period $period Billing period the subscription renews on (same shape as the create body's period)
     * @param WhitelabelRenewalMode|string $renewalMode Whether the subscription auto-renews (renew) or lapses at
     *     period end (expire, i.e. cancelled)
     * @param \DateTimeImmutable|null $expiresOn End of the current paid term; on an expiring config, when serving
     *     stops
     * @param \DateTimeImmutable|null $gracePeriodEndsAt End of the grace period, if the subscription is in one
     * @param \DateTimeImmutable|null $renewScheduledAt When the next automatic renewal runs; only surfaced on a
     *     renewing config
     */
    public function __construct(
        public Period $period,
        public WhitelabelRenewalMode|string $renewalMode,
        public ?\DateTimeImmutable $expiresOn = null,
        public ?\DateTimeImmutable $gracePeriodEndsAt = null,
        public ?\DateTimeImmutable $renewScheduledAt = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): static
    {
        return new self(
            period: Period::fromArray($data['period']),
            renewalMode: WhitelabelRenewalMode::tryFrom($data['renewal_mode']) ?? $data['renewal_mode'],
            expiresOn: isset($data['expires_on']) ? new \DateTimeImmutable($data['expires_on']) : null,
            gracePeriodEndsAt: isset($data['grace_period_ends_at']) ? new \DateTimeImmutable($data['grace_period_ends_at']) : null,
            renewScheduledAt: isset($data['renew_scheduled_at']) ? new \DateTimeImmutable($data['renew_scheduled_at']) : null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return Serializer::normalize([
            'period' => $this->period,
            'renewal_mode' => $this->renewalMode,
            'expires_on' => $this->expiresOn,
            'grace_period_ends_at' => $this->gracePeriodEndsAt,
            'renew_scheduled_at' => $this->renewScheduledAt,
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
