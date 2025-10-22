<?php

declare(strict_types=1);

namespace WHMCS\Module\Registrar\OpusDNS\Util;

trait ModelTrait
{
    
    public function toArray(): array
    {
        return get_object_vars($this);
    }
    
    protected function parseDateField(array $data, string $field): ?\DateTimeImmutable
    {
        if (!isset($data[$field])) {
            return null;
        }

        try {
            if ($data[$field] instanceof \DateTimeImmutable) {
                return $data[$field];
            }

            // Handle arrays and objects gracefully
            if (is_array($data[$field]) || is_object($data[$field])) {
                return null;
            }

            // Convert to string first for consistent handling
            $dateString = (string)$data[$field];

            if (empty(trim($dateString))) {
                return null;
            }

            return new \DateTimeImmutable($dateString);
        } catch (\Throwable $e) {
            // Log or handle parsing error gracefully
            return null;
        }
    }
}
