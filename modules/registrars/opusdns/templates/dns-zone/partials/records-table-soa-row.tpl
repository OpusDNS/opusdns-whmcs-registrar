<tr x-show="!loading && zone?.soa" x-cloak class="soa-row">
    <td class="row-checkbox position-sticky" style="left: 0;"></td>
    <td class="row-name"><span x-text="displayName(domainName)"></span></td>
    <td class="row-ttl"><span x-text="zone?.soa?.ttl"></span></td>
    <td class="row-type"><span class="badge badge-secondary">SOA</span></td>
    <td class="row-value">
        <span class="d-block fs-14" x-text="zone?.soa?.raw"></span>
    </td>
    <td class="row-actions position-sticky" style="right: 0;">
        <span x-show="zone?.soa?.raw" x-cloak>
            {include file="modules/registrars/opusdns/templates/dns-zone/partials/copy-button.tpl" text="zone.soa.raw"}
        </span>
    </td>
</tr>