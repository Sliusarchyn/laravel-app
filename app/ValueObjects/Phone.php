<?php

namespace App\ValueObjects;

use InvalidArgumentException;

class Phone
{
    private function __construct(private readonly string $phone)
    {
    }

    public static function fromString(string $phone): Phone
    {
        if (!preg_match('/^\+1\d{10}$/', $phone)) {
            throw new InvalidArgumentException('It is not valid phone value');
        }

        return new self($phone);
    }

    public function toString(): string
    {
        return $this->phone;
    }
}
