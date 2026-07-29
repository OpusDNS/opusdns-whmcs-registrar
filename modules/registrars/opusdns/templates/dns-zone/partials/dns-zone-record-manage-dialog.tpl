<div class="modal fade" id="rrsetManageModal" tabindex="-1" role="dialog" aria-labelledby="rrsetManageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form x-on:submit.prevent="updateRrset()">
                <div class="modal-header">
                    <h5 class="modal-title" id="rrsetManageModalLabel">
                        <span x-text="isEditing ? '{$LANG.opusdns.dns_zone.modals.record.edit_title}' : '{$LANG.opusdns.dns_zone.modals.record.add_title}'"></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" :disabled="saving">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="max-height: 80vh; overflow-y: auto; overflow-x: hidden;">
                    <template x-if="formError">
                        <div class="alert alert-danger d-flex align-items-center">
                            <span x-text="formError"></span>
                        </div>
                    </template>
                    <div class="form-group">
                        <label for="record-name">{$LANG.opusdns.dns_zone.modals.record.labels.name}</label>
                        <div class="input-group">
                            <input type="text" id="record-name" x-model="formData.name" placeholder="{$LANG.opusdns.dns_zone.modals.record.placeholders.name}" class="form-control" :disabled="isEditing">
                            <div class="input-group-append">
                                <span class="input-group-text" x-text="'.' + domainName"></span>
                            </div>
                        </div>
                        <small class="form-text text-muted">{$LANG.opusdns.dns_zone.modals.record.help.name}</small>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="record-type">{$LANG.opusdns.dns_zone.modals.record.labels.type}</label>
                                <select id="record-type" x-model="formData.type" class="form-control" :disabled="isEditing">
                                    <template x-for="type in recordTypes" :key="type">
                                        <option :value="type" x-text="type"></option>
                                    </template>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="record-ttl">{$LANG.opusdns.dns_zone.modals.record.labels.ttl}</label>
                                <input type="number" id="record-ttl" x-model.number="formData.ttl" class="form-control" :placeholder="DNS_ZONE_RECORD_DEFAULT_TTL">
                            </div>
                        </div>
                    </div>

                    <div class="form-group" x-show="formData.type">
                        <label x-text="
                                formData.type === DNS_ZONE_RECORD_TYPES.A ? '{$LANG.opusdns.dns_zone.records.types.a.label}' :
                                formData.type === DNS_ZONE_RECORD_TYPES.AAAA ? '{$LANG.opusdns.dns_zone.records.types.aaaa.label}' :
                                formData.type === DNS_ZONE_RECORD_TYPES.ALIAS ? '{$LANG.opusdns.dns_zone.records.types.alias.label}' :
                                formData.type === DNS_ZONE_RECORD_TYPES.CNAME ? '{$LANG.opusdns.dns_zone.records.types.cname.label}' :
                                formData.type === DNS_ZONE_RECORD_TYPES.TXT ? '{$LANG.opusdns.dns_zone.records.types.txt.label}' :
                                formData.type === DNS_ZONE_RECORD_TYPES.MX ? '{$LANG.opusdns.dns_zone.records.types.mx.title}' :
                                formData.type === DNS_ZONE_RECORD_TYPES.SRV ? '{$LANG.opusdns.dns_zone.records.types.srv.title}' :
                                formData.type === DNS_ZONE_RECORD_TYPES.CAA ? '{$LANG.opusdns.dns_zone.records.types.caa.title}' :
                                formData.type === DNS_ZONE_RECORD_TYPES.SMIMEA ? '{$LANG.opusdns.dns_zone.records.types.smimea.title}' :
                                formData.type === DNS_ZONE_RECORD_TYPES.TLSA ? '{$LANG.opusdns.dns_zone.records.types.tlsa.title}' :
                                formData.type === DNS_ZONE_RECORD_TYPES.URI ? '{$LANG.opusdns.dns_zone.records.types.uri.title}' :
                                'Record Value'
                            "></label>

                        <template x-if="formData.type === DNS_ZONE_RECORD_TYPES.MX">
                            <small class="form-text text-muted mb-2">{$LANG.opusdns.dns_zone.records.types.mx.help}</small>
                        </template>
                        <template x-if="formData.type === DNS_ZONE_RECORD_TYPES.SRV">
                            <small class="form-text text-muted mb-2">{$LANG.opusdns.dns_zone.records.types.srv.help}</small>
                        </template>
                        <template x-if="formData.type === DNS_ZONE_RECORD_TYPES.CAA">
                            <small class="form-text text-muted mb-2">{$LANG.opusdns.dns_zone.records.types.caa.help}</small>
                        </template>
                        <template x-if="formData.type === DNS_ZONE_RECORD_TYPES.SMIMEA">
                            <small class="form-text text-muted mb-2">{$LANG.opusdns.dns_zone.records.types.smimea.help}</small>
                        </template>
                        <template x-if="formData.type === DNS_ZONE_RECORD_TYPES.TLSA">
                            <small class="form-text text-muted mb-2">{$LANG.opusdns.dns_zone.records.types.tlsa.help}</small>
                        </template>
                        <template x-if="formData.type === DNS_ZONE_RECORD_TYPES.URI">
                            <small class="form-text text-muted mb-2">{$LANG.opusdns.dns_zone.records.types.uri.help}</small>
                        </template>

                        <template x-if="formData.type === DNS_ZONE_RECORD_TYPES.TLSA">
                            <div class="row mb-2">
                                <div class="col-6">
                                    <label>{$LANG.opusdns.dns_zone.records.types.tlsa.port}</label>
                                    <input type="number" x-model.number="formData.port" placeholder="443" min="0" max="65535" class="form-control form-control-sm">
                                </div>
                                <div class="col-6">
                                    <label>{$LANG.opusdns.dns_zone.records.types.tlsa.protocol}</label>
                                    <select x-model="formData.protocol" class="form-control form-control-sm">
                                        <option value="tcp">tcp</option>
                                        <option value="udp">udp</option>
                                        <option value="sctp">sctp</option>
                                    </select>
                                </div>
                            </div>
                        </template>

                        <template x-if="[DNS_ZONE_RECORD_TYPES.A, DNS_ZONE_RECORD_TYPES.AAAA, DNS_ZONE_RECORD_TYPES.ALIAS, DNS_ZONE_RECORD_TYPES.CNAME, DNS_ZONE_RECORD_TYPES.TXT].includes(formData.type)">
                            <template x-for="(value, idx) in formData.records" :key="idx">
                                <div class="input-group mb-2">
                                    <template x-if="formData.type === DNS_ZONE_RECORD_TYPES.TXT">
                                        <textarea x-model="formData.records[idx]" :placeholder="DNS_ZONE_RECORD_DEFINITIONS[formData.type].placeholder" class="form-control" rows="3"></textarea>
                                    </template>
                                    <template x-if="formData.type !== DNS_ZONE_RECORD_TYPES.TXT">
                                        <input type="text" x-model="formData.records[idx]" :placeholder="DNS_ZONE_RECORD_DEFINITIONS[formData.type].placeholder" class="form-control">
                                    </template>
                                    <div class="input-group-append">
                                        <button type="button" x-on:click="removeRecordValue(idx)" :disabled="formData.records.length <= 1" class="btn btn-outline-danger">
                                            <i class="far fa-trash fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </template>

                        <template x-if="formData.type === DNS_ZONE_RECORD_TYPES.MX">
                            <template x-for="(mx, idx) in formData.records" :key="idx">
                                <div class="border rounded p-3 mb-2 bg-light">
                                    <div class="row">
                                        <div class="col-2">
                                            <label :for="'mx-priority-' + idx">{$LANG.opusdns.dns_zone.records.types.mx.priority}</label>
                                            <input type="number" :id="'mx-priority-' + idx" x-model.number="formData.records[idx].priority" placeholder="10" min="0" max="65535" class="form-control">
                                        </div>
                                        <div class="col-8">
                                            <label :for="'mx-server-' + idx">{$LANG.opusdns.dns_zone.records.types.mx.server}</label>
                                            <input type="text" :id="'mx-server-' + idx" x-model="formData.records[idx].hostname" placeholder="mail.example.com." class="form-control">
                                        </div>
                                        <div class="col-2 d-flex align-items-end">
                                            <button type="button" x-on:click="removeRecordValue(idx)" :disabled="formData.records.length <= 1" class="btn btn-outline-danger">
                                                <i class="far fa-trash fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </template>

                        <template x-if="formData.type === DNS_ZONE_RECORD_TYPES.SRV">
                            <template x-for="(srv, idx) in formData.records" :key="idx">
                                <div class="border rounded p-3 mb-2 bg-light">
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <label :for="'srv-priority-' + idx">{$LANG.opusdns.dns_zone.records.types.srv.priority}</label>
                                            <input type="number" :id="'srv-priority-' + idx" x-model.number="formData.records[idx].priority" placeholder="10" min="0" max="65535" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-3">
                                            <label :for="'srv-weight-' + idx">{$LANG.opusdns.dns_zone.records.types.srv.weight}</label>
                                            <input type="number" :id="'srv-weight-' + idx" x-model.number="formData.records[idx].weight" placeholder="5" min="0" max="65535" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-3">
                                            <label :for="'srv-port-' + idx">{$LANG.opusdns.dns_zone.records.types.srv.port}</label>
                                            <input type="number" :id="'srv-port-' + idx" x-model.number="formData.records[idx].port" placeholder="443" min="0" max="65535" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-3 d-flex align-items-end">
                                            <button type="button" x-on:click="removeRecordValue(idx)" :disabled="formData.records.length <= 1" class="btn btn-outline-danger btn-sm">
                                                <i class="far fa-trash fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <label :for="'srv-target-' + idx">{$LANG.opusdns.dns_zone.records.types.srv.target}</label>
                                            <input type="text" :id="'srv-target-' + idx" x-model="formData.records[idx].target" placeholder="server.example.com." class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </template>

                        <template x-if="formData.type === DNS_ZONE_RECORD_TYPES.CAA">
                            <template x-for="(caa, idx) in formData.records" :key="idx">
                                <div class="border rounded p-3 mb-2 bg-light">
                                    <div class="row">
                                        <div class="col-2">
                                            <label :for="'caa-flags-' + idx">{$LANG.opusdns.dns_zone.records.types.caa.flags}</label>
                                            <input type="number" :id="'caa-flags-' + idx" x-model.number="formData.records[idx].flags" placeholder="0" min="0" max="255" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-3">
                                            <label :for="'caa-tag-' + idx">{$LANG.opusdns.dns_zone.records.types.caa.tag}</label>
                                            <select :id="'caa-tag-' + idx" x-model="formData.records[idx].tag" class="form-control form-control-sm">
                                                <option value="issue">issue</option>
                                                <option value="issuewild">issuewild</option>
                                                <option value="iodef">iodef</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label :for="'caa-value-' + idx">{$LANG.opusdns.dns_zone.records.types.caa.value}</label>
                                            <input type="text" :id="'caa-value-' + idx" x-model="formData.records[idx].value" placeholder="letsencrypt.org" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-1 d-flex align-items-end">
                                            <button type="button" x-on:click="removeRecordValue(idx)" :disabled="formData.records.length <= 1" class="btn btn-outline-danger btn-sm">
                                                <i class="far fa-trash fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </template>

                        <template x-if="formData.type === DNS_ZONE_RECORD_TYPES.SMIMEA || formData.type === DNS_ZONE_RECORD_TYPES.TLSA">
                            <template x-for="(cert, idx) in formData.records" :key="idx">
                                <div class="border rounded p-3 mb-2 bg-light">
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <label x-text="formData.type === DNS_ZONE_RECORD_TYPES.TLSA ? '{$LANG.opusdns.dns_zone.records.types.tlsa.usage}' : '{$LANG.opusdns.dns_zone.records.types.smimea.usage}'"></label>
                                            <input type="number" x-model.number="formData.records[idx].usage" placeholder="3" min="0" max="255" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-3">
                                            <label x-text="formData.type === DNS_ZONE_RECORD_TYPES.TLSA ? '{$LANG.opusdns.dns_zone.records.types.tlsa.selector}' : '{$LANG.opusdns.dns_zone.records.types.smimea.selector}'"></label>
                                            <input type="number" x-model.number="formData.records[idx].selector" placeholder="1" min="0" max="255" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-3">
                                            <label x-text="formData.type === DNS_ZONE_RECORD_TYPES.TLSA ? '{$LANG.opusdns.dns_zone.records.types.tlsa.matching_type}' : '{$LANG.opusdns.dns_zone.records.types.smimea.matching_type}'"></label>
                                            <input type="number" x-model.number="formData.records[idx].matchingType" placeholder="1" min="0" max="255" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-3 d-flex align-items-end">
                                            <button type="button" x-on:click="removeRecordValue(idx)" :disabled="formData.records.length <= 1" class="btn btn-outline-danger btn-sm">
                                                <i class="far fa-trash fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <label x-text="formData.type === DNS_ZONE_RECORD_TYPES.TLSA ? '{$LANG.opusdns.dns_zone.records.types.tlsa.certificate}' : '{$LANG.opusdns.dns_zone.records.types.smimea.certificate}'"></label>
                                            <textarea x-model="formData.records[idx].certificateData" placeholder="certificate_data" class="form-control form-control-sm" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </template>

                        <template x-if="formData.type === DNS_ZONE_RECORD_TYPES.URI">
                            <template x-for="(uri, idx) in formData.records" :key="idx">
                                <div class="border rounded p-3 mb-2 bg-light">
                                    <div class="row">
                                        <div class="col-2">
                                            <label>{$LANG.opusdns.dns_zone.records.types.uri.priority}</label>
                                            <input type="number" x-model.number="formData.records[idx].priority" placeholder="10" min="0" max="65535" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-9">
                                            <label>{$LANG.opusdns.dns_zone.records.types.uri.target}</label>
                                            <input type="text" x-model="formData.records[idx].target" placeholder="https://example.com" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-1 d-flex align-items-end">
                                            <button type="button" x-on:click="removeRecordValue(idx)" :disabled="formData.records.length <= 1" class="btn btn-outline-danger btn-sm">
                                                <i class="far fa-trash fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </template>

                        <template x-if="formData.type && formData.type !== DNS_ZONE_RECORD_TYPES.CNAME">
                            <button type="button" x-on:click="addRecordValue()" x-show="canAddMoreRecords(formData.type)" class="btn btn-outline-secondary btn-sm mt-1">
                                <i class="far fa-plus mr-1"></i>
                                <span x-text="
                                    formData.type === DNS_ZONE_RECORD_TYPES.A ? '{$LANG.opusdns.dns_zone.records.types.a.add_another}' :
                                    formData.type === DNS_ZONE_RECORD_TYPES.AAAA ? '{$LANG.opusdns.dns_zone.records.types.aaaa.add_another}' :
                                    formData.type === DNS_ZONE_RECORD_TYPES.ALIAS ? '{$LANG.opusdns.dns_zone.records.types.alias.add_another}' :
                                    formData.type === DNS_ZONE_RECORD_TYPES.TXT ? '{$LANG.opusdns.dns_zone.records.types.txt.add_another}' :
                                    formData.type === DNS_ZONE_RECORD_TYPES.MX ? '{$LANG.opusdns.dns_zone.records.types.mx.add_another}' :
                                    formData.type === DNS_ZONE_RECORD_TYPES.SRV ? '{$LANG.opusdns.dns_zone.records.types.srv.add_another}' :
                                    formData.type === DNS_ZONE_RECORD_TYPES.CAA ? '{$LANG.opusdns.dns_zone.records.types.caa.add_another}' :
                                    formData.type === DNS_ZONE_RECORD_TYPES.SMIMEA ? '{$LANG.opusdns.dns_zone.records.types.smimea.add_another}' :
                                    formData.type === DNS_ZONE_RECORD_TYPES.TLSA ? '{$LANG.opusdns.dns_zone.records.types.tlsa.add_another}' :
                                    formData.type === DNS_ZONE_RECORD_TYPES.URI ? '{$LANG.opusdns.dns_zone.records.types.uri.add_another}' :
                                    'Add another'
                                "></span>
                            </button>
                        </template>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" :disabled="saving">
                        {$LANG.opusdns.dns_zone.actions.cancel}
                    </button>
                    <button type="submit" :disabled="saving" class="btn btn-primary">
                        <span x-show="saving" x-cloak>
                            {include file="modules/registrars/opusdns/templates/partials/spinner.tpl" class="spinner-icon-sm mr-1"}
                            {$LANG.opusdns.dns_zone.modals.record.actions.saving}
                        </span>
                        <span x-show="!saving" x-text="isEditing ? '{$LANG.opusdns.dns_zone.modals.record.actions.update}' : '{$LANG.opusdns.dns_zone.modals.record.actions.add}'"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>