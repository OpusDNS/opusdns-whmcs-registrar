<div class="modal fade" id="setNameserversModal" tabindex="-1" role="dialog" aria-labelledby="setNameserversModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 480px;" role="document">
        <div class="modal-content small">
            <div class="modal-header">
                <h5 class="modal-title" id="setNameserversModalLabel">{$LANG.opusdns.dns_zone.modals.set_nameservers.title}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" :disabled="settingNameservers">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                <p class="mb-3">{$LANG.opusdns.dns_zone.modals.set_nameservers.desc}</p>
                <div class="list-group mb-3">
                    <template x-for="ns in zone?.nameservers" :key="ns">
                        <div class="list-group-item">
                            <span x-text="ns"></span>
                        </div>
                    </template>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" :disabled="settingNameservers">{$LANG.opusdns.dns_zone.actions.cancel}</button>
                <button type="button" class="btn btn-primary" x-on:click="confirmSetNameservers()" :disabled="settingNameservers">
                    <span x-show="!settingNameservers">{$LANG.opusdns.dns_zone.modals.set_nameservers.confirm}</span>
                    <span x-show="settingNameservers" x-cloak>
                        {include file="modules/registrars/opusdns/templates/partials/spinner.tpl" class="spinner-icon-sm mr-1"}
                        {$LANG.opusdns.dns_zone.modals.set_nameservers.loading}
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>