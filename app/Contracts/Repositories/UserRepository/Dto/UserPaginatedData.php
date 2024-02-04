<?php

declare(strict_types=1);

namespace App\Contracts\Repositories\UserRepository\Dto;

use App\Contracts\Common\Dto\PaginatedData;
use App\Models\User;

/**
 * @extends PaginatedData<User>
 * @property array<User> $items
 */
class UserPaginatedData extends PaginatedData
{
    protected static string $instance = User::class;
}
