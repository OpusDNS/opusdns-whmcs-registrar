<div class="modal fade" id="deleteRrsetModal" tabindex="-1" role="dialog" aria-labelledby="deleteRrsetModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 480px;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteRrsetModalLabel">{$LANG.opusdns.dns_zone.modals.delete_record.title}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" :disabled="deletingRecord">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                <p class="mb-3">{$LANG.opusdns.dns_zone.modals.delete_record.desc}</p>
                <div>
                    <div class="mb-1">
                        <small class="text-muted d-block">{$LANG.opusdns.dns_zone.records.table.name}</small>
                        <strong x-text="recordToDelete?.name" class="text-break" style="font-size: 14px;"></strong>
                    </div>
                    <div class="mb-1">
                        <small class="text-muted d-block">{$LANG.opusdns.dns_zone.records.table.type}</small>
                        <span class="badge badge-info" x-text="recordToDelete?.type"></span>
                    </div>
                    <div>
                        <small class="text-muted d-block">{$LANG.opusdns.dns_zone.records.table.value}</small>
                        <template x-for="(entry, index) in recordToDelete?.records || []" :key="index">
                            <code class="small d-block text-break" style="font-size: 13px;" x-text="entry.rdata"></code>
                        </template>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" :disabled="deletingRecord">{$LANG.opusdns.dns_zone.actions.cancel}</button>
                <button type="button" class="btn btn-danger" x-on:click="deleteRrset()" :disabled="deletingRecord">
                    <span x-show="!deletingRecord">{$LANG.opusdns.dns_zone.modals.delete_record.confirm}</span>
                    <span x-show="deletingRecord" x-cloak>
                        {include file="modules/registrars/opusdns/templates/partials/spinner.tpl" class="spinner-icon-sm mr-1"}
                        {$LANG.opusdns.dns_zone.modals.delete_record.loading}
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>