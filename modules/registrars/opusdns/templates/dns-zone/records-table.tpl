<section class="records-section">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h6 class="mb-0">
            {$LANG.opusdns.dns_zone.records.title}
            <span class="badge badge-info ml-2" x-show="!loading" x-cloak x-text="rrsets.length"></span>
        </h6>
        <div class="d-flex align-items-center">
            <div class="btn-group" role="group">
                <template x-if="selectedRecords.length === 0">
                    <button type="button" class="btn btn-outline-primary rounded-left" x-on:click="openRrsetAddModal()" :disabled="loading">
                        <i class="far fa-plus fa-sm mr-1"></i> {$LANG.opusdns.dns_zone.modals.record.actions.add}
                    </button>
                </template>
                <template x-if="selectedRecords.length > 0">
                    <button type="button" class="btn btn-danger rounded-left" x-on:click="confirmDeleteRrsets()" :disabled="loading">
                        <i class="far fa-trash-alt fa-sm mr-1"></i>
                        <span x-text="'{$LANG.opusdns.dns_zone.actions.delete_selected}'.replace('%d', selectedRecords.length)"></span>
                    </button>
                </template>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" :disabled="loading">
                        <span class="sr-only">Actions</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left mt-1">
                        <a class="dropdown-item" href="javascript:void(0)" x-on:click="openTemplateModal()">
                            <i class="fas fa-magic fa-sm mr-1"></i>
                            {$LANG.opusdns.dns_zone.actions.dropdown.apply_template}
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)" x-on:click="toggleDnssec(!zone.dnssec.enabled)" x-show="zone?.dnssec && !togglingDnssec">
                            <i class="fas fa-shield-alt fa-sm mr-1"></i>
                            <span x-text="zone?.dnssec?.enabled ? '{$LANG.opusdns.dns_zone.actions.dropdown.disable_dnssec}' : '{$LANG.opusdns.dns_zone.actions.dropdown.enable_dnssec}'"></span>
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)" x-on:click="exportZone()">
                            <i class="fas fa-download fa-sm mr-1"></i>
                            {$LANG.opusdns.dns_zone.actions.dropdown.export_zone}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="javascript:void(0)" x-on:click="confirmDeleteZone()">
                            <i class="fas fa-trash-alt fa-sm mr-1"></i>
                            {$LANG.opusdns.dns_zone.actions.dropdown.delete_zone}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="position-relative">
        <div class="loading-overlay" x-show="loading" x-cloak>
            {include file="modules/registrars/opusdns/templates/partials/spinner.tpl" class="text-primary"}
        </div>
        <div class="mb-2">
            {include file="modules/registrars/opusdns/templates/dns-zone/partials/records-table-filters.tpl"}
        </div>
        <div class="table-responsive border rounded">
            <table class="table dns-table my-0 py-0">
                {include file="modules/registrars/opusdns/templates/dns-zone/partials/records-table-header.tpl"}
                <tbody>
                    <tr x-show="!loading && rrsets.length === 0" x-cloak>
                        <td colspan="6" class="text-center py-4 bg-white small">
                            <i class="far fa-folder-open mb-3" style="font-size: 32px; opacity: 0.3;"></i>
                            <h6>{$LANG.opusdns.dns_zone.records.empty.no_records}</h6>
                            <p class="text-muted mb-0">{$LANG.opusdns.dns_zone.records.empty.no_records_desc}</p>
                        </td>
                    </tr>
                    <tr x-show="!loading && rrsets.length > 0 && filteredRecords.length === 0" x-cloak>
                        <td colspan="6" class="text-center py-4 bg-white small">
                            <i class="far fa-search mb-3" style="font-size: 32px; opacity: 0.3;"></i>
                            <h6>{$LANG.opusdns.dns_zone.records.empty.no_match}</h6>
                            <p class="text-muted mb-0">{$LANG.opusdns.dns_zone.records.empty.no_match_desc}</p>
                        </td>
                    </tr>
                    <tr x-show="loading && rrsets.length === 0" x-cloak>
                        <td colspan="6">&nbsp;</td>
                    </tr>
                    <template x-for="record in filteredRecords" :key="record.id">
                        {include file="modules/registrars/opusdns/templates/dns-zone/partials/records-table-row.tpl"}
                    </template>
                </tbody>
            </table>
        </div>
    </div>
</section>