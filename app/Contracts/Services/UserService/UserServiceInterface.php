<?php

declare(strict_types=1);

namespace App\Contracts\Services\UserService;

use App\Contracts\Common\Dto\PaginationData;
use App\Contracts\Repositories\UserRepository\Dto\Filter;
use App\Contracts\Repositories\UserRepository\Dto\UserPaginatedData;
use App\Contracts\Services\UserService\Dto\CreationData;
use App\Contracts\Services\UserService\Dto\UpdateData;
use App\Models\User;
use App\ValueObjects\Phone;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use LogicException;

interface UserServiceInterface
{
    /**
     * @param PaginationData $paginationData
     * @param Filter|null $filter
     * @return UserPaginatedData<User>
     */
    public function paginate(PaginationData $paginationData, ?Filter $filter = null): UserPaginatedData;

    /**
     * @param int $userId
     * @return User
     * @throws ModelNotFoundException
     */
    public function findById(int $userId): User;

    /**
     * @throws LogicException
     */
    public function create(CreationData $data): User;

    /**
     * @param int $id
     * @param UpdateData $data
     * @return User
     */
    public function update(int $id, UpdateData $data): User;

    /**
     * @param int $id
     * @return void
     * @throws ModelNotFoundException
     */
    public function deleteById(int $id): void;

    /**
     * @param Phone $phone
     * @return void
     */
    public function deleteByPhone(Phone $phone): void;
}
