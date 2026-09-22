<?php

/**
 * This file is generated from the OpenAPI specification by bin/generate.
 * Do not edit it by hand; regenerate it instead.
 */

declare(strict_types=1);

namespace OpusDNS\Client\Service;

/**
 * Gives Client one accessor per API tag. Used by OpusDNS\Client\Client.
 */
trait ServiceAccessors
{
    public function aiConcierge(): AiConciergeService
    {
        return new AiConciergeService($this);
    }

    public function archive(): ArchiveService
    {
        return new ArchiveService($this);
    }

    public function authentication(): AuthenticationService
    {
        return new AuthenticationService($this);
    }

    public function availability(): AvailabilityService
    {
        return new AvailabilityService($this);
    }

    public function contact(): ContactService
    {
        return new ContactService($this);
    }

    public function dns(): DnsService
    {
        return new DnsService($this);
    }

    public function domain(): DomainService
    {
        return new DomainService($this);
    }

    public function domainForward(): DomainForwardService
    {
        return new DomainForwardService($this);
    }

    public function domainSearch(): DomainSearchService
    {
        return new DomainSearchService($this);
    }

    public function emailForward(): EmailForwardService
    {
        return new EmailForwardService($this);
    }

    public function event(): EventService
    {
        return new EventService($this);
    }

    public function host(): HostService
    {
        return new HostService($this);
    }

    public function jobs(): JobsService
    {
        return new JobsService($this);
    }

    public function vanityNameservers(): VanityNameserversService
    {
        return new VanityNameserversService($this);
    }

    public function organization(): OrganizationService
    {
        return new OrganizationService($this);
    }

    public function parking(): ParkingService
    {
        return new ParkingService($this);
    }

    public function report(): ReportService
    {
        return new ReportService($this);
    }

    public function tag(): TagService
    {
        return new TagService($this);
    }

    public function tld(): TldService
    {
        return new TldService($this);
    }

    public function user(): UserService
    {
        return new UserService($this);
    }

    public function whitelabel(): WhitelabelService
    {
        return new WhitelabelService($this);
    }
}
