<?php

declare(strict_types=1);

namespace App\Contracts\Common\Dto;

class PaginationData
{
    public function __construct(
        public readonly int $page = 1,
        public readonly int $perPage = 20
    ) {
    }
}
