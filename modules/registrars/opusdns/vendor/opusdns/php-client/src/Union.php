<?php

declare(strict_types=1);

namespace OpusDNS\Client;

/**
 * Picks the model class for a union of object schemas.
 */
final class Union
{
    /**
     * Chooses by discriminator property, as declared in the specification.
     *
     * @template T of ApiModel
     * @param array<string, mixed> $data
     * @param array<string|int, class-string<T>> $mapping Discriminator value to model class
     * @return T
     */
    public static function discriminate(array $data, string $property, array $mapping): ApiModel
    {
        $value = $data[$property] ?? null;
        if ((!is_string($value) && !is_int($value)) || !isset($mapping[$value])) {
            throw new \UnexpectedValueException(sprintf(
                "Cannot resolve union: discriminator '%s' is %s, expected one of %s",
                $property,
                json_encode($value),
                implode(', ', array_map(strval(...), array_keys($mapping))),
            ));
        }

        return $mapping[$value]::fromArray($data);
    }

    /**
     * Chooses the first candidate whose required keys are all present, most specific candidates first.
     *
     * @template T of ApiModel
     * @param array<string, mixed> $data
     * @param array<class-string<T>, list<string>> $candidates Model class to its required keys
     * @return T
     */
    public static function hydrate(array $data, array $candidates): ApiModel
    {
        foreach ($candidates as $class => $requiredKeys) {
            foreach ($requiredKeys as $key) {
                if (!array_key_exists($key, $data)) {
                    continue 2;
                }
            }

            return $class::fromArray($data);
        }

        $first = array_key_first($candidates);
        if ($first === null) {
            throw new \LogicException('A union needs at least one candidate class.');
        }

        return $first::fromArray($data);
    }
}
