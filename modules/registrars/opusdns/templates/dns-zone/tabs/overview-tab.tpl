<div class="mb-4" x-show="!zoneNotFound && (loading || zone)" x-cloak>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row my-0">
                <label class="col-4 col-form-label zone-label">{$LANG.opusdns.dns_zone.overview.labels.domain}</label>
                <div class="col-8 d-flex align-items-center"><strong class="zone-value">{$domain}</strong></div>
            </div>
            <div class="form-group row my-0">
                <label class="col-4 col-form-label zone-label">{$LANG.opusdns.dns_zone.overview.labels.created}</label>
                <div class="col-8 d-flex align-items-center">
                    <span class="skeleton skeleton-text" x-show="loading && !zone?.created_on" x-cloak style="width: 100px;"></span>
                    <span class="zone-value" x-show="zone?.created_on" x-cloak x-text="zone?.created_on || ''"></span>
                </div>
            </div>
            <div class="form-group row my-0">
                <label class="col-4 col-form-label zone-label">{$LANG.opusdns.dns_zone.overview.labels.updated}</label>
                <div class="col-8 d-flex align-items-center">
                    <span class="skeleton skeleton-text" x-show="loading && !zone?.updated_on" x-cloak style="width: 100px;"></span>
                    <span class="zone-value" x-show="zone?.updated_on" x-cloak x-text="zone?.updated_on || ''"></span>
                </div>
            </div>
            <div class="form-group row my-0">
                <label class="col-4 col-form-label zone-label">{$LANG.opusdns.dns_zone.overview.labels.dnssec}</label>
                <div class="col-8 d-flex align-items-center">
                    <span class="skeleton skeleton-text" x-show="loading && !zone?.dnssec" x-cloak style="width: 60px;"></span>
                    <a href="#" class="badge badge-success py-1" x-show="zone?.dnssec?.enabled" x-cloak x-on:click.prevent="activeTab = 'dnssec'" x-tooltip="{$LANG.opusdns.dns_zone.dnssec.status.enabled_tooltip}">
                        <i class="fas fa-shield-check"></i> {$LANG.opusdns.dns_zone.dnssec.status.enabled}
                    </a>
                    <a href="#" class="badge badge-secondary py-1" x-show="zone?.dnssec && !zone.dnssec.enabled" x-cloak x-on:click.prevent="activeTab = 'dnssec'" x-tooltip="{$LANG.opusdns.dns_zone.dnssec.status.disabled_tooltip}">
                        <i class="far fa-shield-alt"></i> {$LANG.opusdns.dns_zone.dnssec.status.disabled}
                    </a>
                </div>
            </div>
            <div class="form-group row my-0 mb-md-0">
                <label class="col-4 col-form-label zone-label">{$LANG.opusdns.dns_zone.overview.labels.nameservers}</label>
                <div class="col-8 d-flex align-items-center">
                    <span class="skeleton skeleton-text" x-show="loading && domain?.delegated === undefined" x-cloak style="width: 80px;"></span>
                    <a href="#" class="badge badge-success py-1" x-show="domain?.delegated === true" x-cloak x-on:click.prevent="activeTab = 'nameservers'" x-tooltip="{$LANG.opusdns.dns_zone.nameservers.status.delegated_tooltip}">
                        <i class="far fa-check-circle"></i> {$LANG.opusdns.dns_zone.nameservers.status.delegated}
                    </a>
                    <a href="#" class="badge badge-warning py-1" x-show="domain?.delegated === false" x-cloak x-on:click.prevent="activeTab = 'nameservers'" x-tooltip="{$LANG.opusdns.dns_zone.nameservers.status.not_delegated_tooltip}">
                        <i class="far fa-exclamation-triangle"></i> {$LANG.opusdns.dns_zone.nameservers.status.not_delegated}
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-light">
                <div class="card-header py-2 px-3 d-flex justify-content-between align-items-center">
                    <h6 class="text-uppercase my-1" style="font-size: 0.75rem; font-weight: 600; ">{$LANG.opusdns.dns_zone.overview.soa.title}</h6>
                    <span x-show="zone?.soa?.raw" x-cloak>
                        {include file="modules/registrars/opusdns/templates/dns-zone/partials/copy-button.tpl" text="zone.soa.raw"}
                    </span>
                </div>
                <div class="card-body py-2 px-3 zone-soa position-relative">
                    <div class="loading-overlay" x-show="loading && !zone?.soa" x-cloak>
                        {include file="modules/registrars/opusdns/templates/partials/spinner.tpl" class="text-primary"}
                    </div>
                    <div class="row" style="font-size: 0.75rem;">
                        <div class="col-12 col-md-5 text-muted">{$LANG.opusdns.dns_zone.overview.soa.primary_ns}</div>
                        <div class="col-12 col-md-7">
                            <span x-text="zone?.soa?.primary_ns"></span>
                        </div>
                    </div>
                    <div class="row" style="font-size: 0.75rem;">
                        <div class="col-12 col-md-5 text-muted">{$LANG.opusdns.dns_zone.overview.soa.admin_email}</div>
                        <div class="col-12 col-md-7">
                            <span x-text="zone?.soa?.email"></span>
                        </div>
                    </div>
                    <div class="row" style="font-size: 0.75rem;">
                        <div class="col-12 col-md-5 text-muted">{$LANG.opusdns.dns_zone.overview.soa.serial}</div>
                        <div class="col-12 col-md-7">
                            <span x-text="zone?.soa?.serial"></span>
                        </div>
                    </div>
                    <div class="row" style="font-size: 0.75rem;">
                        <div class="col-12 col-md-5 text-muted">{$LANG.opusdns.dns_zone.overview.soa.refresh}</div>
                        <div class="col-12 col-md-7">
                            <span x-text="zone?.soa?.refresh"></span>
                        </div>
                    </div>
                    <div class="row" style="font-size: 0.75rem;">
                        <div class="col-12 col-md-5 text-muted">{$LANG.opusdns.dns_zone.overview.soa.retry}</div>
                        <div class="col-12 col-md-7">
                            <span x-text="zone?.soa?.retry"></span>
                        </div>
                    </div>
                    <div class="row" style="font-size: 0.75rem;">
                        <div class="col-12 col-md-5 text-muted">{$LANG.opusdns.dns_zone.overview.soa.expire}</div>
                        <div class="col-12 col-md-7">
                            <span x-text="zone?.soa?.expire"></span>
                        </div>
                    </div>
                    <div class="row" style="font-size: 0.75rem;">
                        <div class="col-12 col-md-5 text-muted">{$LANG.opusdns.dns_zone.overview.soa.min_ttl}</div>
                        <div class="col-12 col-md-7">
                            <span x-text="zone?.soa?.min_ttl"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{include file="modules/registrars/opusdns/templates/dns-zone/partials/delegation-warning.tpl"}

<div x-show="!zoneNotFound" x-cloak>
    {include file="modules/registrars/opusdns/templates/dns-zone/records-table.tpl"}
</div>