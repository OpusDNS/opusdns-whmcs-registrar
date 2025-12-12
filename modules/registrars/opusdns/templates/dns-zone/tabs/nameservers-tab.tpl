<div x-show="loading" x-cloak class="text-center py-4">
    {include file="modules/registrars/opusdns/templates/partials/spinner.tpl" class="text-primary"}
</div>

<div x-show="!loading" x-cloak>
    <div class="d-flex justify-content-between align-items-center mb-3 small">
        <h5 class="mb-0">{$LANG.opusdns.dns_zone.tabs.nameservers}</h5>
    </div>
    <div class="alert alert-success mb-4 small" x-show="domain?.delegated === true" x-cloak>
        <i class="far fa-check-circle mr-1"></i>
        <strong>{$LANG.opusdns.dns_zone.nameservers.states.delegated.title}</strong> - {$LANG.opusdns.dns_zone.nameservers.states.delegated.desc}
    </div>
    <div x-show="domain?.delegated === false" x-cloak>
        <div class="mb-4">
            <div class="text-uppercase small text-muted mb-2">{$LANG.opusdns.dns_zone.nameservers.current.title}</div>
            <div class="mb-0">
                <template x-for="(ns, i) in domain?.nameservers || []" :key="ns">
                    <span class="badge badge-secondary mr-1 mb-1" x-text="ns"></span>
                </template>
                <span x-show="!domain?.nameservers?.length" x-cloak class="text-muted small">{$LANG.opusdns.dns_zone.nameservers.current.none_configured}</span>
            </div>
        </div>
        <div class="alert alert-warning mb-3 small">
            <i class="fas fa-exclamation-triangle mr-1"></i>
            <strong>{$LANG.opusdns.dns_zone.nameservers.states.not_delegated.title}</strong> - {$LANG.opusdns.dns_zone.nameservers.states.not_delegated.desc}
        </div>
    </div>

    <p class="text-muted small mb-3">
        {$LANG.opusdns.dns_zone.nameservers.current.info}
    </p>

    <button type="button" class="btn btn-primary mb-4" x-show="domain?.delegated === false" x-cloak x-on:click="setNameservers()">
        {$LANG.opusdns.dns_zone.modals.set_nameservers.confirm}
    </button>

    <div class="row">
        <template x-for="(ns, i) in zone?.nameservers || []" :key="ns">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body py-2 px-3 d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-uppercase small text-muted" x-text="'{$LANG.opusdns.dns_zone.nameservers.current.label}' + ' ' + (i + 1)"></div>
                            <span class="font-monospace small" x-text="ns"></span>
                        </div>
                        {include file="modules/registrars/opusdns/templates/dns-zone/partials/copy-button.tpl" text="ns"}
                    </div>
                </div>
            </div>
        </template>
    </div>
    <p class="text-muted small mb-0">
        <i class="fas fa-clock mr-1"></i>
        {$LANG.opusdns.dns_zone.nameservers.current.propagation_notice}
    </p>
</div>