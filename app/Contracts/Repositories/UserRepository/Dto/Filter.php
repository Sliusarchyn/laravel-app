<?php

declare(strict_types=1);

namespace App\Contracts\Repositories\UserRepository\Dto;

readonly class Filter
{
    private function __construct(
        public ?string $name,
        public ?string $phone,
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
