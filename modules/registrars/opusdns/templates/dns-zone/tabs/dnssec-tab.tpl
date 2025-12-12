<div x-show="loading" x-cloak class="text-center py-4">
    {include file="modules/registrars/opusdns/templates/partials/spinner.tpl" class="text-primary"}
</div>

<div x-show="!loading" x-cloak>
    <div class="d-flex justify-content-between align-items-center mb-3 small">
        <h5 class="mb-0">{$LANG.opusdns.dns_zone.tabs.dnssec}</h5>
        <div>
            <button type="button" class="btn btn-success" x-show="!zone?.dnssec?.enabled" x-cloak x-on:click="toggleDnssec(true)">
                {$LANG.opusdns.dns_zone.actions.dropdown.enable_dnssec}
            </button>
            <button type="button" class="btn btn-danger" x-show="zone?.dnssec?.enabled" x-cloak x-on:click="toggleDnssec(false)">
                {$LANG.opusdns.dns_zone.actions.dropdown.disable_dnssec}
            </button>
        </div>
    </div>

    <div x-show="!zone?.dnssec?.enabled" x-cloak class="text-center py-4 small">
        <i class="far fa-shield-alt mb-3 text-muted" style="font-size: 48px; opacity: 0.3;"></i>
        <h5>{$LANG.opusdns.dns_zone.dnssec.states.not_enabled.title}</h5>
        <p class="text-muted mb-0">{$LANG.opusdns.dns_zone.dnssec.states.not_enabled.desc}</p>
    </div>

    <div x-show="zone?.dnssec?.enabled" x-cloak>
        <div class="alert alert-success mb-4 small">
            <i class="far fa-check-circle mr-1" style="vertical-align: -1px;"></i> <strong>{$LANG.opusdns.dns_zone.dnssec.states.enabled.title}</strong> - {$LANG.opusdns.dns_zone.dnssec.states.enabled.desc}
        </div>

        <div class="mb-4" x-show="zone?.dnssec?.ds_records?.length > 0" x-cloak>
            <h6 class="text-uppercase font-weight-bold text-muted mb-3">{$LANG.opusdns.dns_zone.dnssec.records.ds.title}</h6>
            <p class="text-muted small mb-3">
                <i class="far fa-info-circle mr-1" style="vertical-align: -1px;"></i> {$LANG.opusdns.dns_zone.dnssec.records.ds.help}
            </p>
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <thead class="thead-light small">
                        <tr>
                            <th>{$LANG.opusdns.dns_zone.dnssec.records.ds.key_tag}</th>
                            <th>{$LANG.opusdns.dns_zone.dnssec.records.ds.algorithm}</th>
                            <th>{$LANG.opusdns.dns_zone.dnssec.records.ds.digest_type}</th>
                            <th>{$LANG.opusdns.dns_zone.dnssec.records.ds.digest}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="ds in zone?.dnssec?.ds_records || []" :key="ds.key_tag + '-' + ds.digest_type">
                            <tr class="small">
                                <td x-text="ds.key_tag"></td>
                                <td x-text="ds.algorithm"></td>
                                <td x-text="ds.digest_type"></td>
                                <td class="text-break" style="max-width: 400px;" x-text="ds.digest"></td>
                                <td class="text-right">
                                    {include file="modules/registrars/opusdns/templates/dns-zone/partials/copy-button.tpl" text="ds.raw"}
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>

        <div x-show="zone?.dnssec?.dnskey_records?.length > 0" x-cloak>
            <h6 class="text-uppercase font-weight-bold text-muted mb-3">{$LANG.opusdns.dns_zone.dnssec.records.dnskey.title}</h6>
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <thead class="thead-light small">
                        <tr>
                            <th>{$LANG.opusdns.dns_zone.dnssec.records.dnskey.flags}</th>
                            <th>{$LANG.opusdns.dns_zone.dnssec.records.dnskey.protocol}</th>
                            <th>{$LANG.opusdns.dns_zone.dnssec.records.dnskey.algorithm}</th>
                            <th>{$LANG.opusdns.dns_zone.dnssec.records.dnskey.public_key}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="key in zone?.dnssec?.dnskey_records || []" :key="key.flags + '-' + key.public_key?.substring(0, 20)">
                            <tr class="small">
                                <td>
                                    <span x-text="key.flags"></span>
                                    <span class="badge badge-info ml-1" x-show="key.flags === 257" x-cloak>KSK</span>
                                    <span class="badge badge-secondary ml-1" x-show="key.flags === 256" x-cloak>ZSK</span>
                                </td>
                                <td x-text="key.protocol"></td>
                                <td x-text="key.algorithm"></td>
                                <td class="text-break" style="max-width: 400px; word-break: break-all;" x-text="key.public_key"></td>
                                <td class="text-right">
                                    {include file="modules/registrars/opusdns/templates/dns-zone/partials/copy-button.tpl" text="key.raw"}
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>