<?php

namespace App\Domain\ValueObjects;

use DomainException;

class EmailValueObject
{
    private string $value;

    public function __construct(string $value)
    {
        if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new DomainException("Invalid email '{$value}'.");
        }

        $this->value = $value;
    }

    public function __toString()
    {
        return $this->value;
    }
}
