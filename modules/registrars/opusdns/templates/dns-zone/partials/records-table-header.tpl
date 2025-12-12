<thead>
    <tr>
        <th class="col-checkbox position-sticky" style="left: 0;">
            <input type="checkbox" :checked="allSelected" :indeterminate="someSelected" x-on:click="toggleSelectAll()" :disabled="loading || filteredRecords.length === 0">
        </th>
        <th class="col-name sortable" x-on:click="doSort('name')">
            {$LANG.opusdns.dns_zone.records.table.name}
            <span x-html="getSortIcon('name')"></span>
        </th>
        <th class="col-type sortable" x-on:click="doSort('type')">
            {$LANG.opusdns.dns_zone.records.table.type}
            <span x-html="getSortIcon('type')"></span>
        </th>
        <th class="col-ttl sortable" x-on:click="doSort('ttl')">
            {$LANG.opusdns.dns_zone.records.table.ttl}
            <span x-html="getSortIcon('ttl')"></span>
        </th>
        <th class="col-value">{$LANG.opusdns.dns_zone.records.table.value}</th>
        <th class="col-actions position-sticky" style="right: 0;"></th>
    </tr>
</thead>