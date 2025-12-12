<div class="modal fade" id="templateModal" tabindex="-1" role="dialog" aria-labelledby="templateModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 580px;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="templateModalLabel">
                    {$LANG.opusdns.dns_zone.templates.title}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" :disabled="applyingTemplate">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="overflow: visible;">
                <template x-if="formError">
                    <div class="alert alert-danger d-flex align-items-center">
                        <span x-text="formError"></span>
                    </div>
                </template>
                <div class="form-group mb-2">
                    <label class="mb-1">
                        {$LANG.opusdns.dns_zone.templates.template_label}
                    </label>
                    <div class="dropdown flex-grow-1">
                        <button type="button" class="btn btn-template-select" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" :disabled="loadingTemplates">
                            <span class="template-content">
                                <span x-show="!selectedTemplate" x-cloak>{$LANG.opusdns.dns_zone.templates.select_template}</span>
                                <span x-show="selectedTemplate" x-text="selectedTemplate?.name" class="font-weight-bold" style="font-size: 13px;"></span>
                                <span x-show="selectedTemplate?.category" class="badge badge-primary badge-sm" x-text="selectedTemplate?.category" style="text-transform: capitalize;"></span>
                            </span>
                            <span x-show="loadingTemplates" role="status" x-cloak>
                                {include file="modules/registrars/opusdns/templates/partials/spinner.tpl" class="text-primary"}
                            </span>
                        </button>
                        <div class="dropdown-menu mt-1" style="width: 100%;" onclick="event.stopPropagation()">
                            <div class="p-2 border-bottom">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white border-right-0">
                                            <i class="far fa-search text-muted" style="font-size: 12px;"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control border-left-0 pl-0" placeholder="{$LANG.opusdns.dns_zone.templates.search_placeholder}" x-model="templateSearch">
                                </div>
                            </div>
                            <div class="p-2" style="max-height: 400px; overflow-y: auto;">
                                <template x-for="template in templates" :key="template.id">
                                    <div x-show="!templateSearch || template.name.toLowerCase().includes(templateSearch.toLowerCase()) || template.description?.toLowerCase().includes(templateSearch.toLowerCase()) || template.category?.toLowerCase().includes(templateSearch.toLowerCase())">
                                        <button type="button" class="btn btn-light text-left w-100 mb-2 p-2" :class="{ 'bg-primary text-white': selectedTemplateId === template.id }" x-on:click="selectedTemplateId = template.id; onTemplateChange(); $el.closest('.dropdown-menu').previousElementSibling.click();">
                                            <div class="d-flex align-items-start">
                                                <div style="min-width: 0; flex: 1;">
                                                    <div class="mb-1 d-flex align-items-center justify-content-between">
                                                        <span x-text="template.name" class="font-weight-bold" style="font-size: 13px;"></span>
                                                        <template x-if="template.category">
                                                            <span class="badge badge-primary badge-sm ml-2" x-text="template.category" style="text-transform: capitalize;"></span>
                                                        </template>
                                                    </div>
                                                    <div :class="{ 'text-white-50': selectedTemplateId === template.id, 'text-muted': selectedTemplateId !== template.id }" x-text="template.description" style="font-size: 12px;"></div>
                                                </div>
                                            </div>
                                        </button>
                                    </div>
                                </template>
                                <div x-show="templates.length === 0" class="text-center text-muted py-3" style="font-size: 14px;">
                                    {$LANG.opusdns.dns_zone.templates.no_templates_found}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div x-show="selectedTemplate">
                    <div class="form-group mb-2">
                        <label class="mb-1">{$LANG.opusdns.dns_zone.templates.base_name}</label>
                        <div class="input-group">
                            <input type="text" x-model="templateBaseName" x-on:input="updatePreview()" class="form-control" placeholder="@ or subdomain" :disabled="selectedTemplate?.supports_subdomain === false">
                            <div class="input-group-append">
                                <span class="input-group-text" x-text="'.' + domainName"></span>
                            </div>
                        </div>
                        <small class="form-text text-muted" x-show="selectedTemplate?.supports_subdomain !== false">{$LANG.opusdns.dns_zone.templates.base_name_help}</small>
                        <small class="form-text text-danger" x-show="selectedTemplate?.supports_subdomain === false">{$LANG.opusdns.dns_zone.templates.apex_only}</small>
                    </div>
                    <template x-for="variable in selectedTemplate?.variables" :key="variable.name">
                        <div class="form-group mb-2">
                            <label class="mb-1">
                                <span x-text="variable.label"></span>
                                <span x-show="variable.required" class="text-danger">*</span>
                            </label>
                            <input type="text" x-model="templateVariables[variable.name]" x-on:input="updatePreview()" class="form-control form-control-sm" :placeholder="variable.placeholder" :required="variable.required">
                            <small class="form-text text-muted" x-text="variable.description"></small>
                        </div>
                    </template>
                </div>
                <div x-show="selectedTemplate && templatePreviewRecords.length > 0" class="pt-2 mt-2">
                    <div class="alert alert-warning py-2 px-2 mb-2" style="font-size: 14px;">
                        <i class="fas fa-exclamation-triangle mr-1"></i> {$LANG.opusdns.dns_zone.templates.general_warning}
                    </div>
                    <div class="d-flex align-items-center justify-content-between py-2">
                        <small class="text-muted text-uppercase font-weight-bold">{$LANG.opusdns.dns_zone.templates.preview_title}</small>
                        <span x-show="hasConflicts" class="badge badge-warning badge-sm"><i class="fas fa-exclamation-triangle"></i> Conflicts</span>
                    </div>
                    <div class="list-group">
                        <template x-for="(rrset, idx) in templatePreviewRecords" :key="idx">
                            <div class="list-group-item px-1 py-1">
                                <div class="d-flex align-items-start" style="font-size: 13px;">
                                    <div class="p-2 d-flex align-items-center">
                                        <i :class="rrset.action === 'create' ? 'far fa-plus fa-sm text-success' : 'far fa-pencil-alt fa-sm text-warning'"></i>
                                    </div>
                                    <div class="px-2 py-1" style="width: 120px; min-width: 120px; max-width: 120px;">
                                        <span class="text-dark text-break" x-text="displayName(rrset.name)"></span>
                                    </div>
                                    <div class="p-1" style="width: 60px; min-width: 60px; max-width: 60px;">
                                        <span class="badge badge-primary badge-sm" x-text="rrset.type"></span>
                                    </div>
                                    <div class="text-muted p-1" style="width: 50px; min-width: 50px; max-width: 50px;">
                                        <template x-if="rrset.action === 'update' && rrset.existingTtl && rrset.existingTtl !== rrset.ttl">
                                            <div style="text-decoration: line-through;" x-text="rrset.existingTtl"></div>
                                        </template>
                                        <span x-text="rrset.ttl"></span>
                                    </div>
                                    <div class="flex-grow-1 p-1" style="font-size: 13px;">
                                        <template x-if="rrset.action === 'update' && rrset.existingRecords">
                                            <div class="mb-1">
                                                <template x-for="(existingRecord, exIdx) in rrset.existingRecords" :key="exIdx">
                                                    <div class="text-break mb-1 text-danger" style="text-decoration: line-through;">
                                                        <span x-text="existingRecord.rdata" :title="existingRecord.rdata"></span>
                                                    </div>
                                                </template>
                                            </div>
                                        </template>
                                        <template x-for="(record, rIdx) in rrset.records" :key="rIdx">
                                            <div class="text-break mb-1 text-success">
                                                <span x-text="record.rdata" :title="record.rdata"></span>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" :disabled="applyingTemplate">
                    {$LANG.opusdns.dns_zone.actions.cancel}
                </button>
                <button type="button" class="btn btn-success" x-on:click="applyTemplate()" :disabled="applyingTemplate">
                    <span x-show="!applyingTemplate">
                        <i class="fas fa-check fa-sm"></i>
                        {$LANG.opusdns.dns_zone.templates.actions.apply}
                    </span>
                    <span x-show="applyingTemplate">
                        <span class="spinner-border spinner-border-sm" role="status"></span>
                        {$LANG.opusdns.dns_zone.templates.actions.applying}
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>