<?php

declare(strict_types=1);

namespace App\Contracts\Services\UserService;

use App\Contracts\Common\Dto\PaginationData;
use App\Models\User;
use App\ValueObjects\Phone;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use LogicException;

interface UserServiceInterface
{
    /**
     * @param PaginationData $paginationData
     * @return LengthAwarePaginator
     */
    public function paginate(PaginationData $paginationData): LengthAwarePaginator;

    /**
     * @param Phone $phone
     * @return User
     * @throws ModelNotFoundException
     */
    public function findByPhone(Phone $phone): User;

    /**
     * @throws LogicException
     */
    public function create(string $name, Phone $phone): User;

    /**
     * @param int $id
     * @return void
     * @throws ModelNotFoundException
     */
    public function deleteById(int $id): void;
}
