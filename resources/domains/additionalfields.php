<?php

declare(strict_types=1);

// WHMCS loads custom domain fields only from <whmcs_root>/resources/domains/additionalfields.php.
// Copy this file to that path (or merge the include below into an existing one) to surface
// the OpusDNS module's TLD-specific fields (e.g. the .music registrant attestation) at checkout.
//
// The file is admin-owned and may contain entries from other registrars — the include is
// guarded so removing the OpusDNS module degrades gracefully instead of throwing a fatal.

$opusdnsAdditionalFields = __DIR__ . '/../../modules/registrars/opusdns/additionalfields.php';
if (file_exists($opusdnsAdditionalFields)) {
    include $opusdnsAdditionalFields;
}
