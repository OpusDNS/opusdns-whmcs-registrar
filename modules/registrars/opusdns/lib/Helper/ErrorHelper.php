<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Helper;

class ErrorHelper
{
    public static function extractRrsetErrors(array $errors): string
    {
        $messages = [];

        if (isset($errors['rrsets']) && is_array($errors['rrsets'])) {
            foreach ($errors['rrsets'] as $rrsetErrors) {
                if (is_array($rrsetErrors)) {
                    foreach ($rrsetErrors as $fieldErrors) {
                        if (is_array($fieldErrors)) {
                            foreach ($fieldErrors as $error) {
                                if (is_string($error)) {
                                    $messages[] = $error;
                                }
                            }
                        } elseif (is_string($fieldErrors)) {
                            $messages[] = $fieldErrors;
                        }
                    }
                }
            }
        }

        return !empty($messages) ? implode('; ', $messages) : '';
    }
}
