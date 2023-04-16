<?php

namespace App\ValueObjects;

use InvalidArgumentException;

class Email
{
    private function __construct(private readonly string $email)
    {
    }

    public static function fromString(string $email): Email
    {
        $email = strtolower($email);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('It is not valid email value');
        }

        return new self($email);
    }

    public function toString(): string
    {
        return $this->email;
    }

    public function getDomain(): string
    {
        return preg_split('@', $this->email)[1];
    }
}
