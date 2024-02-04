<?php

declare(strict_types=1);

namespace App\Contracts\Services\UserService\Dto;

use App\ValueObjects\Phone;

class CreationData
{
    public function __construct(
        public readonly string $name,
        public readonly Phone $phone,
    ) {
    }
}
