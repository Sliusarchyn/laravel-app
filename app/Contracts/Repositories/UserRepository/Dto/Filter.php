<?php

declare(strict_types=1);

namespace App\Contracts\Repositories\UserRepository\Dto;

class Filter
{
    private function __construct(
        public readonly ?string $name,
        public readonly ?string $phone,
    ) {
    }

    /**
     * @param array<string, string|null> $filter
     * @return Filter
     */
    public static function fromArray(array $filter): Filter
    {
        return new self(
            $filter['name'] ?? null,
            $filter['phone'] ?? null,
        );
    }
}
