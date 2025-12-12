<div class="modal fade" id="deleteRrsetsModal" tabindex="-1" role="dialog" aria-labelledby="deleteRrsetsModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 480px;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteRrsetsModalLabel">{$LANG.opusdns.dns_zone.modals.delete_selected_records.title}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" :disabled="deletingRecord">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p x-text="'{$LANG.opusdns.dns_zone.modals.delete_selected_records.desc}'.replace('%d', selectedRecords.length)"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" :disabled="deletingRecord">{$LANG.opusdns.dns_zone.actions.cancel}</button>
                <button type="button" class="btn btn-danger" x-on:click="deleteRrsets()" :disabled="deletingRecord">
                    <span x-show="!deletingRecord">{$LANG.opusdns.dns_zone.modals.delete_selected_records.confirm}</span>
                    <span x-show="deletingRecord" x-cloak>
                        {include file="modules/registrars/opusdns/templates/partials/spinner.tpl" class="spinner-icon-sm mr-1"}
                        {$LANG.opusdns.dns_zone.modals.delete_selected_records.loading}
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>