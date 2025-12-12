<div class="modal fade" id="exportModal" tabindex="-1" role="dialog" aria-labelledby="exportModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 480px;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exportModalLabel">{$LANG.opusdns.dns_zone.modals.export.title}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-muted mb-3">{$LANG.opusdns.dns_zone.modals.export.desc}</p>
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action" x-on:click.prevent="exportFormat = DNS_ZONE_EXPORT_FORMATS.BIND" :class="{ 'active': exportFormat === DNS_ZONE_EXPORT_FORMATS.BIND }">
                        <div class="d-flex align-items-center mb-1">
                            <i class="far fa-file-alt mr-2"></i>
                            <strong>{$LANG.opusdns.dns_zone.modals.export.formats.bind.title}</strong>
                        </div>
                        <small>{$LANG.opusdns.dns_zone.modals.export.formats.bind.desc}</small>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action" x-on:click.prevent="exportFormat = DNS_ZONE_EXPORT_FORMATS.JSON" :class="{ 'active': exportFormat === DNS_ZONE_EXPORT_FORMATS.JSON }">
                        <div class="d-flex align-items-center mb-1">
                            <i class="far fa-file-code mr-2"></i>
                            <strong>{$LANG.opusdns.dns_zone.modals.export.formats.json.title}</strong>
                        </div>
                        <small>{$LANG.opusdns.dns_zone.modals.export.formats.json.desc}</small>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action" x-on:click.prevent="exportFormat = DNS_ZONE_EXPORT_FORMATS.CSV" :class="{ 'active': exportFormat === DNS_ZONE_EXPORT_FORMATS.CSV }">
                        <div class="d-flex align-items-center mb-1">
                            <i class="far fa-file-csv mr-2"></i>
                            <strong>{$LANG.opusdns.dns_zone.modals.export.formats.csv.title}</strong>
                        </div>
                        <small>{$LANG.opusdns.dns_zone.modals.export.formats.csv.desc}</small>
                    </a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {$LANG.opusdns.dns_zone.actions.cancel}
                </button>
                <button type="button" x-on:click="doExport()" class="btn btn-primary">
                    {$LANG.opusdns.dns_zone.actions.export}
                </button>
            </div>
        </div>
    </div>
</div>