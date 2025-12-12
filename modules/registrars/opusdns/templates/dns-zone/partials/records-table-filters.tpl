<div class="d-flex flex-column flex-md-row">
    <div class="filter-item filter-search mb-2 mb-md-0 mr-md-2" style="min-width: 280px;">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="{$LANG.opusdns.dns_zone.records.filters.search_placeholder}" x-model="searchQuery" :disabled="loading" :class="{ 'rounded-right': !searchQuery }">
            <div class="input-group-append" x-show="searchQuery" x-cloak>
                <button type="button" class="btn btn-outline-secondary" x-on:click="searchQuery = ''" title="Clear" :disabled="loading">
                    <i class="far fa-times"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="filter-item filter-type" style="min-width: 220px;">
        <div class="input-group">
            <div class="dropdown flex-grow-1">
                <button type="button" class="btn btn-filters-outline" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" :disabled="loading" :class="{ 'rounded-right': filterType.length === 0 }">
                    <span class="filter-content">
                        <span :class="{ 'text-muted': filterType.length === 0 }">{$LANG.opusdns.dns_zone.records.filters.type}</span>
                        <template x-if="filterType.length > 0">
                            <span class="filter-divider"></span>
                        </template>
                        <template x-if="filterType.length > 0">
                            <span class="filter-badges" style="padding: 2px;">
                                <template x-for="(type, index) in filterType.slice(0, 2)" :key="type">
                                    <span class="badge badge-primary mr-1" x-text="type"></span>
                                </template>
                                <template x-if="filterType.length > 2">
                                    <span class="badge badge-secondary" x-text="'+' + (filterType.length - 2)"></span>
                                </template>
                            </span>
                        </template>
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu-left" style="width: 220px;" onclick="event.stopPropagation()">
                    <div class="p-2 border-bottom">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-right-0">
                                    <i class="far fa-search text-muted" style="font-size: 12px;"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control border-left-0 pl-0" placeholder="{$LANG.opusdns.dns_zone.records.filters.types_placeholder}" x-model="filterSearch">
                        </div>
                    </div>
                    <div class="p-2" style="max-height: 300px; overflow-y: auto;">
                        <template x-for="type in filteredRecordTypes" :key="type">
                            <label class="d-flex align-items-center justify-content-between px-2 py-1 rounded-sm" style="cursor: pointer; margin-bottom: 2px;" :class="{ 'bg-light': isTypeSelected(type) }">
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" class="mr-2" :checked="isTypeSelected(type)" x-on:change="toggleFilterType(type)">
                                    <span x-text="type" style="font-size: 14px; font-weight: 500;"></span>
                                </div>
                                <span class="badge badge-light" x-text="getTypeCount(type)"></span>
                            </label>
                        </template>
                        <div x-show="filteredRecordTypes.length === 0" class="text-center text-muted py-2" style="font-size: 14px;">
                            {$LANG.opusdns.dns_zone.records.filters.no_types_found}
                        </div>
                    </div>
                    <div class="border-top p-2 text-center" x-show="filterType.length > 0">
                        <a href="#" class="text-danger small" x-on:click.prevent="filterType = []">{$LANG.opusdns.dns_zone.records.filters.clear}</a>
                    </div>
                </div>
            </div>
            <div class="input-group-append" x-show="filterType.length > 0" x-cloak>
                <button type="button" class="btn btn-outline-secondary" x-on:click="filterType = []" title="Clear" :disabled="loading">
                    <i class="far fa-times fa-sm"></i>
                </button>
            </div>
        </div>
    </div>
</div>