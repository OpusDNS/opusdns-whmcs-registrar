<div class="d-flex justify-content-between align-items-end">
    <span class="font-weight-bold mb-2">{$LANG.opusdns.dns_zone.title}</span>
    <ul class="nav nav-tabs border-0 mb-0" role="tablist">
        <li class="nav-item">
            <a class="nav-link" :class="{ 'active': activeTab === 'overview' }" href="#" x-on:click.prevent="activeTab = 'overview'" :aria-selected="activeTab === 'overview'" role="tab" :tabindex="activeTab === 'overview' ? 0 : -1">
                <i class="far fa-info-circle mr-1"></i>
                <span class="d-none d-sm-inline">{$LANG.opusdns.dns_zone.tabs.overview}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" :class="{ 'active': activeTab === 'dnssec', 'disabled': !zone }" href="#" x-on:click.prevent="zone && (activeTab = 'dnssec')" :aria-selected="activeTab === 'dnssec'" role="tab" :tabindex="activeTab === 'dnssec' ? 0 : -1">
                <i class="far fa-shield-alt mr-1"></i>
                <span class="d-none d-sm-inline">{$LANG.opusdns.dns_zone.tabs.dnssec}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" :class="{ 'active': activeTab === 'nameservers', 'disabled': !zone }" href="#" x-on:click.prevent="zone && (activeTab = 'nameservers')" :aria-selected="activeTab === 'nameservers'" role="tab" :tabindex="activeTab === 'nameservers' ? 0 : -1">
                <i class="far fa-server mr-1"></i>
                <span class="d-none d-sm-inline">{$LANG.opusdns.dns_zone.tabs.nameservers}</span>
            </a>
        </li>
    </ul>
</div>