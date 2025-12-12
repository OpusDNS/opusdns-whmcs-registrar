<div x-data="notifications" x-on:notify.window="add($event)" aria-live="polite" aria-atomic="true" style="position: fixed; top: 1rem; right: 1rem; z-index: 1070;" x-cloak>
    <template x-for="notification in notifications" :key="notification.id">
        <div x-data="notification" x-show="show" x-transition:enter="fade-in" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="fade-out" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="toast show mb-2" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i x-show="notification.type === 'info'" class="far fa-info-circle text-info mr-2" x-cloak></i>
                <i x-show="notification.type === 'success'" class="far fa-check-circle text-success mr-2" x-cloak></i>
                <i x-show="notification.type === 'error'" class="far fa-exclamation-circle text-danger mr-2" x-cloak></i>
                <strong class="mr-auto text-capitalize" x-text="notification.type"></strong>
                <button type="button" class="ml-2 mb-1 close" x-on:click="transitionOut()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body" x-text="notification.content"></div>
        </div>
    </template>
</div>