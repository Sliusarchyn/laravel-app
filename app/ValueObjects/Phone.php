<?php

namespace App\ValueObjects;

use InvalidArgumentException;
use RuntimeException;

class Phone
{
    private function __construct(private readonly string $phone)
    {
    }

    public static function fromString(string $phone): Phone
    {
        if (!preg_match('/^\+[0-9]{3}\d{2}\d{3}\d{2}\d{2}$/', $phone)) {
            throw new InvalidArgumentException('It is not valid phone value');
        }

        return new self($phone);
    }

    public function toString(): string
    {
        return $this->phone;
    }

    public function getOperatorCode(): string
    {
        //TODO: Some implementation
        throw new RuntimeException('Should be implemented before called');
    }
}
