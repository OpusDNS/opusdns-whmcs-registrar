<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Helper;

class AttributeHelper
{
    // WHMCS additionalfields.php key for the .music registrant attestation tickbox.
    // Must match the 'Name' in additionalfields.php exactly.
    private const MUSIC_ATTESTATION_FIELD = 'Music Registrant Attestation';

    public static function extractFromParams(string $tld, array $params): array
    {
        $fields = $params['additionalfields'] ?? [];
        $attributes = [];

        if ($tld === 'music') {
            if (!empty($fields[self::MUSIC_ATTESTATION_FIELD])) {
                $attributes['music_registrant_attestation'] = 'true';
            }
        }

        return $attributes;
    }

    /**
     * Returns an error message if a TLD-required attribute is missing, or null if OK.
     *
     * WHMCS's `'Required' => true` is only enforced on the customer checkout form —
     * admin-initiated and API-driven registrations bypass it. Without this guard,
     * those flows would hit a cryptic registry rejection downstream.
     */
    public static function validateRequired(string $tld, array $params): ?string
    {
        $attributes = self::extractFromParams($tld, $params);

        if ($tld === 'music' && empty($attributes['music_registrant_attestation'])) {
            return 'The .music TLD requires the registrant attestation. '
                . 'Confirm that the registrant is a member of the global music community.';
        }

        return null;
    }
}
