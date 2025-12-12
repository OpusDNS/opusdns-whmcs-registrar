<div class="modal fade" id="enableDnssecModal" tabindex="-1" role="dialog" aria-labelledby="enableDnssecModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 480px;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="enableDnssecModalLabel">{$LANG.opusdns.dns_zone.modals.enable_dnssec.title}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" :disabled="togglingDnssec">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                <p>{$LANG.opusdns.dns_zone.modals.enable_dnssec.desc}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" :disabled="togglingDnssec">{$LANG.opusdns.dns_zone.actions.cancel}</button>
                <button type="button" class="btn btn-success" x-on:click="confirmToggleDnssec(true)" :disabled="togglingDnssec">
                    <span x-show="!togglingDnssec">{$LANG.opusdns.dns_zone.modals.enable_dnssec.confirm}</span>
                    <span x-show="togglingDnssec" x-cloak>
                        {include file="modules/registrars/opusdns/templates/partials/spinner.tpl" class="spinner-icon-sm mr-1"}
                        {$LANG.opusdns.dns_zone.modals.enable_dnssec.loading}
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="disableDnssecModal" tabindex="-1" role="dialog" aria-labelledby="disableDnssecModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 480px;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="disableDnssecModalLabel">{$LANG.opusdns.dns_zone.modals.disable_dnssec.title}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" :disabled="togglingDnssec">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                <p>{$LANG.opusdns.dns_zone.modals.disable_dnssec.desc}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" :disabled="togglingDnssec">{$LANG.opusdns.dns_zone.actions.cancel}</button>
                <button type="button" class="btn btn-danger" x-on:click="confirmToggleDnssec(false)" :disabled="togglingDnssec">
                    <span x-show="!togglingDnssec">{$LANG.opusdns.dns_zone.modals.disable_dnssec.confirm}</span>
                    <span x-show="togglingDnssec" x-cloak>
                        {include file="modules/registrars/opusdns/templates/partials/spinner.tpl" class="spinner-icon-sm mr-1"}
                        {$LANG.opusdns.dns_zone.modals.disable_dnssec.loading}
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>