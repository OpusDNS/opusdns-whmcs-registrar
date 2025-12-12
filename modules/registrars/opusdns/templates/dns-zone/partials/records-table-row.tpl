<tr>
    <td class="row-checkbox position-sticky" style="left: 0;">
        <input type="checkbox" :checked="isSelected(record.id)" x-on:click="toggleSelectRecord(record.id)" :disabled="loading">
    </td>
    <td class="row-name"><span x-text="displayName(record.name)"></span></td>
    <td class="row-type"><span class="badge badge-primary" x-text="record.type"></span></td>
    <td class="row-ttl"><span x-text="record.ttl"></span></td>
    <td class="row-value">
        <template x-for="rec in record.records" :key="rec.rdata">
            <span class="d-block" style="font-size: 14px;" x-text="rec.rdata"></span>
        </template>
    </td>
    <td class="row-actions position-sticky" style="right: 0;">
        <div class="btn-group btn-group-sm">
            <button type="button" class="btn btn-outline-primary btn-sm" x-on:click="openRrsetUpdateModal(record)" title="{$LANG.opusdns.dns_zone.actions.edit}">
                <i class="far fa-pencil-alt fa-sm"></i>
            </button>
            <button type="button" class="btn btn-outline-danger btn-sm" x-on:click="confirmDeleteRrset(record)" title="{$LANG.opusdns.dns_zone.actions.delete}">
                <i class="far fa-trash fa-sm"></i>
            </button>
        </div>
    </td>
</tr>