<link rel="stylesheet" href="modules/registrars/opusdns/templates/assets/css/opusdns.css">

{include file="modules/registrars/opusdns/templates/notifications.tpl"}

<script>
    let dnsZoneOptions = {
        i18n: {
            notifications: {$LANG.opusdns.dns_zone.notifications|json_encode}
        }
    };
</script>

<div class="dns-zone-management" x-data="dnsZone({$domainid}, '{$domain}', dnsZoneOptions)">
    <div class="card">
        <div class="card-header bg-white pb-0">
            {include file="modules/registrars/opusdns/templates/dns-zone/tabs/tablist.tpl"}
        </div>
        <div class="tab-content">
            <section x-show="activeTab === 'overview'" role="tabpanel" class="tab-pane p-3" :class="{ 'active show': activeTab === 'overview' }">
                {include file="modules/registrars/opusdns/templates/dns-zone/tabs/overview-tab.tpl"}
            </section>
            <section x-show="activeTab === 'dnssec' && !zoneNotFound" role="tabpanel" class="tab-pane p-3" :class="{ 'active show': activeTab === 'dnssec' }">
                {include file="modules/registrars/opusdns/templates/dns-zone/tabs/dnssec-tab.tpl"}
            </section>
            <section x-show="activeTab === 'nameservers' && !zoneNotFound" role="tabpanel" class="tab-pane p-3" :class="{ 'active show': activeTab === 'nameservers' }">
                {include file="modules/registrars/opusdns/templates/dns-zone/tabs/nameservers-tab.tpl"}
            </section>
        </div>
        <section x-show="!loading && zoneNotFound" role="tabpanel" class="tab-pane p-3 text-center" :class="{ 'active show': zoneNotFound }">
            <i class="far fa-exclamation-circle mb-3" style="font-size: 36px; opacity: 0.3;"></i>
            <h5>{$LANG.opusdns.dns_zone.errors.zone_not_created}</h5>
            <p class="text-muted mb-4">{$LANG.opusdns.dns_zone.errors.zone_not_created_desc|replace:'%s':$domain}</p>
            <button type="button" class="btn btn-primary" x-on:click="createZone()" :disabled="creatingZone">
                <template x-if="!creatingZone">
                    <span>{$LANG.opusdns.dns_zone.modals.create_zone.confirm}</span>
                </template>
                <template x-if="creatingZone">
                    <span class="d-inline-flex align-items-center">
                        <span class="spinner-border spinner-border-sm mr-2" role="status"></span>
                        {$LANG.opusdns.dns_zone.modals.create_zone.loading}
                    </span>
                </template>
            </button>
        </section>
    </div>

    {include file="modules/registrars/opusdns/templates/dns-zone/partials/dns-zone-delete-modal.tpl"}
    {include file="modules/registrars/opusdns/templates/dns-zone/partials/dns-zone-record-manage-dialog.tpl"}
    {include file="modules/registrars/opusdns/templates/dns-zone/partials/rrset-delete-modal.tpl"}
    {include file="modules/registrars/opusdns/templates/dns-zone/partials/rrsets-delete-modal.tpl"}
    {include file="modules/registrars/opusdns/templates/dns-zone/partials/set-nameservers-modal.tpl"}
    {include file="modules/registrars/opusdns/templates/dns-zone/partials/dnssec-modals.tpl"}
    {include file="modules/registrars/opusdns/templates/dns-zone/partials/dns-zone-export-dialog.tpl"}
    {include file="modules/registrars/opusdns/templates/dns-zone/partials/dns-template-modal.tpl"}
</div>

<script src="modules/registrars/opusdns/templates/assets/js/opusdns.js" defer></script>