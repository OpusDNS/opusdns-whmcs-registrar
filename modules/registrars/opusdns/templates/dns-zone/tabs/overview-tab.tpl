<div class="row mb-4" x-show="!zoneNotFound && (loading || zone)" x-cloak>
    <div class="col-md-4">
        <div class="overview-card">
            <h6 class="title">{$LANG.opusdns.dns_zone.overview.labels.domain}</h6>
            <div class="content">
                <span>{$domain}</span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="overview-card">
            <h6 class="title">{$LANG.opusdns.dns_zone.overview.labels.dnssec}</h6>
            <div class="content">
                <span class="skeleton skeleton-text" x-show="loading && !zone?.dnssec" x-cloak style="width: 60px;"></span>
                <a href="#" class="badge badge-success py-1" x-show="zone?.dnssec?.enabled" x-cloak x-on:click.prevent="activeTab = 'dnssec'" x-tooltip="{$LANG.opusdns.dns_zone.dnssec.status.enabled_tooltip}">
                    <i class="fas fa-shield-check"></i> {$LANG.opusdns.dns_zone.dnssec.status.enabled}
                </a>
                <a href="#" class="badge badge-secondary py-1" x-show="zone?.dnssec && !zone.dnssec.enabled" x-cloak x-on:click.prevent="activeTab = 'dnssec'" x-tooltip="{$LANG.opusdns.dns_zone.dnssec.status.disabled_tooltip}">
                    <i class="far fa-shield-alt"></i> {$LANG.opusdns.dns_zone.dnssec.status.disabled}
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="overview-card">
            <h6 class="title">{$LANG.opusdns.dns_zone.overview.labels.nameservers}</h6>
            <div class="content">
                <span class="skeleton skeleton-text" x-show="loading && domain?.delegated === undefined" x-cloak style="width: 80px;"></span>
                <a href="#" class="badge badge-success" x-show="domain?.delegated === true" x-cloak x-on:click.prevent="activeTab = 'nameservers'" x-tooltip="{$LANG.opusdns.dns_zone.nameservers.status.delegated_tooltip}">
                    <i class="far fa-check-circle"></i> {$LANG.opusdns.dns_zone.nameservers.status.delegated}
                </a>
                <a href="#" class="badge badge-warning" x-show="domain?.delegated === false" x-cloak x-on:click.prevent="activeTab = 'nameservers'" x-tooltip="{$LANG.opusdns.dns_zone.nameservers.status.not_delegated_tooltip}">
                    <i class="far fa-exclamation-triangle"></i> {$LANG.opusdns.dns_zone.nameservers.status.not_delegated}
                </a>
            </div>
        </div>
    </div>
</div>
{include file="modules/registrars/opusdns/templates/dns-zone/partials/delegation-warning.tpl"}

<div x-show="!zoneNotFound" x-cloak>
    {include file="modules/registrars/opusdns/templates/dns-zone/records-table.tpl"}
</div>