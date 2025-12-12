<div class="modal fade" id="deleteZoneModal" tabindex="-1" role="dialog" aria-labelledby="deleteZoneModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 480px;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteZoneModalLabel">{$LANG.opusdns.dns_zone.modals.delete_zone.title}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" :disabled="deletingZone">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                <p>{$LANG.opusdns.dns_zone.modals.delete_zone.desc|sprintf:$domain}</p>
                <p>{$LANG.opusdns.dns_zone.modals.delete_zone.warning}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" :disabled="deletingZone">{$LANG.opusdns.dns_zone.actions.cancel}</button>
                <button type="button" class="btn btn-danger" x-on:click="deleteZone()" :disabled="deletingZone">
                    <span x-show="!deletingZone">{$LANG.opusdns.dns_zone.modals.delete_zone.confirm}</span>
                    <span x-show="deletingZone" x-cloak>
                        {include file="modules/registrars/opusdns/templates/partials/spinner.tpl" class="spinner-icon-sm mr-1"}
                        {$LANG.opusdns.dns_zone.modals.delete_zone.loading}
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>
