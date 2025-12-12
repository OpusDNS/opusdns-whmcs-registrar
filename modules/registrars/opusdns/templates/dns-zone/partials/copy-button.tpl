<button type="button" class="btn btn-sm btn-link text-muted p-0" x-data="clipboard" x-tooltip="{$LANG.opusdns.dns_zone.actions.copy}" x-on:click="!copyNotification && (copyToClipboard({$text}), $dispatch('notify', { type: 'success', content: '{$LANG.opusdns.dns_zone.actions.copied}' }))" title="{$LANG.opusdns.dns_zone.actions.copy}" x-bind:disabled="copyNotification">
    <i x-show="!copyNotification" x-cloak class="far fa-copy"></i>
    <i x-show="copyNotification" x-cloak class="far fa-check text-success"></i>
</button>