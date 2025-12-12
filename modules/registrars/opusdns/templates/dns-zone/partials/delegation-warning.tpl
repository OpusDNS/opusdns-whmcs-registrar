<div class="zone-delegation-warning" x-show="!loading && !zoneNotFound && domain?.delegated === false">
    <div class="d-flex align-items-start">
        <i class="fas fa-exclamation-circle text-warning mr-3 mt-1 flex-shrink-0" style="font-size: 24px;"></i>
        <div class="flex-grow-1 small">
            <strong>{$LANG.opusdns.dns_zone.modals.delegation_warning.title}</strong>
            <p class="mb-0 text-muted">{$LANG.opusdns.dns_zone.modals.delegation_warning.desc}</p>
        </div>
        <a href="#" class="btn btn-outline-danger btn-sm ml-3" x-on:click.prevent="activeTab = 'nameservers'">{$LANG.opusdns.dns_zone.modals.delegation_warning.action}</a>
    </div>
</div>