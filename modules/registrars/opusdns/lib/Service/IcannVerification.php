<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Service;

use OpusDNS\Client\Client;
use OpusDNS\Client\Enum\DomainVerificationKind;
use OpusDNS\Client\Enum\DomainVerificationTrigger;
use OpusDNS\Client\Enum\VerificationDeadlineType;
use OpusDNS\Client\Model\ActiveDomainVerificationResponse;
use OpusDNS\Client\Model\DomainResponse;
use WHMCS\Carbon;
use WHMCS\Domain\Registrar\Domain;
use WHMCS\Module\Registrar\OpusDNS\Models\Tld;

/**
 * Presents the active ICANN verification case of a domain through the WHMCS Transfer Policy fields and resends its
 * verification email.
 */
class IcannVerification
{
    public function __construct(private readonly Client $client)
    {
    }

    public static function applyTo(Domain $whmcsDomain, DomainResponse $domain, ?Tld $tldInfo): void
    {
        $verification = self::activeCase($domain);

        $whmcsDomain->setIsIrtpEnabled($verification !== null);

        if ($verification === null) {
            return;
        }

        $whmcsDomain->setDomainContactChangePending(true);
        $whmcsDomain->setPendingSuspension(self::leadsToSuspension($verification, $tldInfo));
        $whmcsDomain->setDomainContactChangeExpiryDate(self::deadline($verification));
    }

    /**
     * Returns false when the domain has no active ICANN case.
     */
    public function resendEmail(string $domainName): bool
    {
        $verification = self::activeCase($this->client->domain()->getDomain($domainName));

        if ($verification === null) {
            return false;
        }

        $this->client->domain()->resendDomainVerification($domainName, $verification->verificationId);

        return true;
    }

    private static function activeCase(DomainResponse $domain): ?ActiveDomainVerificationResponse
    {
        foreach ($domain->activeVerifications ?? [] as $verification) {
            if ($verification->source === DomainVerificationKind::ICANN) {
                return $verification;
            }
        }

        return null;
    }

    /**
     * WHMCS shows the verification notice for a suspension and the contact change notice otherwise.
     */
    private static function leadsToSuspension(ActiveDomainVerificationResponse $verification, ?Tld $tldInfo): bool
    {
        return $verification->trigger !== DomainVerificationTrigger::REGISTRANT_CHANGE
            && $tldInfo?->suspendsOnFailedEmailVerification() === true;
    }

    private static function deadline(ActiveDomainVerificationResponse $verification): ?Carbon
    {
        foreach ($verification->deadlines as $deadline) {
            if ($deadline->type === VerificationDeadlineType::VERIFICATION) {
                return Carbon::parse($deadline->date->format('Y-m-d H:i:s'));
            }
        }

        return null;
    }
}
