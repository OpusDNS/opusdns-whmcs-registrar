{if $notice}
    <div class="alert alert-{$notice.type}" role="alert">
        <i class="far {if $notice.type === 'success'}fa-check-circle{else}fa-exclamation-circle{/if} mr-1"></i>
        {$notice.message|escape}
    </div>
{/if}

{if !$supported}
    <div class="card">
        <div class="card-header bg-white font-weight-bold">{$LANG.opusdns.dnssec.title}</div>
        <div class="card-body">
            <p class="text-muted mb-0">{$LANG.opusdns.dnssec.not_supported}</p>
        </div>
    </div>
{else}
    <div class="card mb-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <span class="font-weight-bold">{$LANG.opusdns.dnssec.records.title}</span>
            {if $records}
                <form method="post" action="{$pageUrl|escape}" class="mb-0" data-confirm="{$LANG.opusdns.dnssec.confirm.remove_all|escape}" onsubmit="return confirm(this.dataset.confirm);">
                    <input type="hidden" name="token" value="{$token}">
                    <input type="hidden" name="dnssec_action" value="remove_all">
                    <button type="submit" class="btn btn-sm btn-outline-danger">
                        <i class="far fa-trash-alt mr-1"></i>
                        {$LANG.opusdns.dnssec.actions.remove_all}
                    </button>
                </form>
            {/if}
        </div>

        {if $records}
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="small text-muted text-nowrap">
                        <tr>
                            {if $recordType === 'key_data'}
                                <th class="border-top-0">{$LANG.opusdns.dnssec.fields.flags}</th>
                                <th class="border-top-0">{$LANG.opusdns.dnssec.fields.protocol}</th>
                                <th class="border-top-0">{$LANG.opusdns.dnssec.fields.algorithm}</th>
                                <th class="border-top-0">{$LANG.opusdns.dnssec.fields.public_key}</th>
                            {else}
                                <th class="border-top-0">{$LANG.opusdns.dnssec.fields.key_tag}</th>
                                <th class="border-top-0">{$LANG.opusdns.dnssec.fields.algorithm}</th>
                                <th class="border-top-0">{$LANG.opusdns.dnssec.fields.digest_type}</th>
                                <th class="border-top-0">{$LANG.opusdns.dnssec.fields.digest}</th>
                            {/if}
                            <th class="border-top-0" style="width: 1%;"><span class="sr-only">{$LANG.opusdns.dnssec.actions.remove}</span></th>
                        </tr>
                    </thead>
                    <tbody class="small">
                        {foreach $records as $record}
                            {if $recordType === 'key_data'}
                                {assign var=recordValue value=$record.public_key}
                            {else}
                                {assign var=recordValue value=$record.digest}
                            {/if}
                            <tr>
                                {if $recordType === 'key_data'}
                                    <td class="align-middle text-nowrap">
                                        {$record.key_role|default:$record.flags|escape}
                                        {if $record.key_role}<span class="text-muted">({$record.flags|escape})</span>{/if}
                                    </td>
                                    <td class="align-middle text-nowrap">{$record.protocol|escape}</td>
                                {else}
                                    <td class="align-middle text-nowrap">{$record.key_tag|escape}</td>
                                {/if}
                                <td class="align-middle text-nowrap">
                                    {$record.algorithm_name|default:$record.algorithm|escape}
                                    {if $record.algorithm_name}<span class="text-muted">({$record.algorithm|escape})</span>{/if}
                                </td>
                                {if $recordType !== 'key_data'}
                                    <td class="align-middle text-nowrap">
                                        {$record.digest_type_name|default:$record.digest_type|escape}
                                        {if $record.digest_type_name}<span class="text-muted">({$record.digest_type|escape})</span>{/if}
                                    </td>
                                {/if}
                                <td class="align-middle text-monospace" style="min-width: 240px; word-break: break-all;">{$recordValue|escape}</td>
                                <td class="align-middle text-nowrap">
                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-copy="{$recordValue|escape}" onclick="opusdnsCopyDnssecValue(this);" title="{$LANG.opusdns.dnssec.actions.copy|escape}" aria-label="{$LANG.opusdns.dnssec.actions.copy|escape}">
                                        <i class="far fa-copy"></i>
                                    </button>
                                    <form method="post" action="{$pageUrl|escape}" class="d-inline-block mb-0 ml-1" data-confirm="{$LANG.opusdns.dnssec.confirm.remove|escape}" onsubmit="return confirm(this.dataset.confirm);">
                                        <input type="hidden" name="token" value="{$token}">
                                        <input type="hidden" name="dnssec_action" value="remove">
                                        <input type="hidden" name="record_id" value="{$record.id|escape}">
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="{$LANG.opusdns.dnssec.actions.remove|escape}" aria-label="{$LANG.opusdns.dnssec.actions.remove|escape}">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
            </div>
        {else}
            <div class="card-body text-center py-5">
                <i class="far fa-shield-alt text-muted mb-3" style="font-size: 40px; opacity: 0.4;"></i>
                <h6 class="font-weight-bold mb-1">{$LANG.opusdns.dnssec.empty.title}</h6>
                <p class="text-muted small mb-0">{$LANG.opusdns.dnssec.empty.desc}</p>
            </div>
        {/if}
    </div>

    <div class="card">
        <div class="card-header bg-white font-weight-bold">
            {$LANG.opusdns.dnssec.add.title}
        </div>
        <form method="post" action="{$pageUrl|escape}">
            <div class="card-body">
                <input type="hidden" name="token" value="{$token}">
                <input type="hidden" name="dnssec_action" value="add">

                {if $recordType === 'key_data'}
                    <div class="form-row">
                        <div class="form-group col-sm-4">
                            <label for="dnssecFlags">{$LANG.opusdns.dnssec.fields.flags}</label>
                            <select id="dnssecFlags" name="dnssec[flags]" class="form-control" required>
                                <option value="257"{if $formData.flags == 257} selected{/if}>257 - KSK</option>
                                <option value="256"{if $formData.flags == 256} selected{/if}>256 - ZSK</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="dnssecProtocol">{$LANG.opusdns.dnssec.fields.protocol}</label>
                            <input type="number" id="dnssecProtocol" name="dnssec[protocol]" class="form-control" min="0" max="255" required aria-describedby="dnssecProtocolHint" value="{$formData.protocol|escape}">
                            <small id="dnssecProtocolHint" class="form-text text-muted">{$LANG.opusdns.dnssec.hints.protocol}</small>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="dnssecAlgorithm">{$LANG.opusdns.dnssec.fields.algorithm}</label>
                            <select id="dnssecAlgorithm" name="dnssec[algorithm]" class="form-control" required>
                                {foreach $algorithmOptions as $algorithmValue => $algorithmLabel}
                                    <option value="{$algorithmValue}"{if $formData.algorithm == $algorithmValue} selected{/if}>{$algorithmLabel|escape}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <label for="dnssecPublicKey">{$LANG.opusdns.dnssec.fields.public_key}</label>
                        <textarea id="dnssecPublicKey" name="dnssec[public_key]" class="form-control text-monospace" rows="4" required spellcheck="false" aria-describedby="dnssecPublicKeyHint">{$formData.public_key|default:''|escape}</textarea>
                        <small id="dnssecPublicKeyHint" class="form-text text-muted">{$LANG.opusdns.dnssec.hints.public_key}</small>
                    </div>
                {else}
                    <div class="form-row">
                        <div class="form-group col-sm-4">
                            <label for="dnssecKeyTag">{$LANG.opusdns.dnssec.fields.key_tag}</label>
                            <input type="number" id="dnssecKeyTag" name="dnssec[key_tag]" class="form-control" min="0" max="65535" required aria-describedby="dnssecKeyTagHint" value="{$formData.key_tag|default:''|escape}">
                            <small id="dnssecKeyTagHint" class="form-text text-muted">{$LANG.opusdns.dnssec.hints.key_tag}</small>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="dnssecAlgorithm">{$LANG.opusdns.dnssec.fields.algorithm}</label>
                            <select id="dnssecAlgorithm" name="dnssec[algorithm]" class="form-control">
                                {foreach $algorithmOptions as $algorithmValue => $algorithmLabel}
                                    <option value="{$algorithmValue}"{if $formData.algorithm == $algorithmValue} selected{/if}>{$algorithmLabel|escape}</option>
                                {/foreach}
                            </select>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="dnssecDigestType">{$LANG.opusdns.dnssec.fields.digest_type}</label>
                            <select id="dnssecDigestType" name="dnssec[digest_type]" class="form-control">
                                {foreach $digestTypeOptions as $digestTypeValue => $digestTypeLabel}
                                    <option value="{$digestTypeValue}"{if $formData.digest_type == $digestTypeValue} selected{/if}>{$digestTypeLabel|escape}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <label for="dnssecDigest">{$LANG.opusdns.dnssec.fields.digest}</label>
                        <input type="text" id="dnssecDigest" name="dnssec[digest]" class="form-control text-monospace" required spellcheck="false" autocomplete="off" aria-describedby="dnssecDigestHint" value="{$formData.digest|default:''|escape}">
                        <small id="dnssecDigestHint" class="form-text text-muted">{$LANG.opusdns.dnssec.hints.digest}</small>
                    </div>
                {/if}
            </div>
            <div class="card-footer bg-white text-right">
                <button type="submit" class="btn btn-primary">
                    <i class="far fa-plus mr-1"></i>
                    {$LANG.opusdns.dnssec.actions.add}
                </button>
            </div>
        </form>
    </div>

    <script>
        {literal}
        function opusdnsCopyDnssecValue(copyButton) {
            navigator.clipboard.writeText(copyButton.dataset.copy).then(function () {
                const copyIcon = copyButton.querySelector('i');
                copyIcon.className = 'far fa-check';
                setTimeout(function () {
                    copyIcon.className = 'far fa-copy';
                }, 1500);
            });
        }
        {/literal}
    </script>
{/if}
