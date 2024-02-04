<?php

declare(strict_types=1);

namespace App\Contracts\Repositories\UserRepository;

use App\Contracts\Common\Dto\PaginationData;
use App\Contracts\Repositories\UserRepository\Dto\Filter;
use App\Contracts\Repositories\UserRepository\Dto\UserPaginatedData;
use App\Models\User;
use App\ValueObjects\Phone;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface UserRepositoryInterface
{
    /**
     * @param PaginationData $paginationData
     * @param Filter|null $filter
     * @return UserPaginatedData
     */
    public function paginate(PaginationData $paginationData, ?Filter $filter = null): UserPaginatedData;

    /**
     * @param int $id
     * @return User
     * @throws ModelNotFoundException
     */
    public function findById(int $id): User;

    /**
     * @param Phone $phone
     * @return User
     * @throws ModelNotFoundException
     */
    public function findByPhone(Phone $phone): User;

    /**
     * @param User $user
     * @return User
     */
    public function save(User $user): User;

    /**
     * @param User $user
     * @return void
     */
    public function delete(User $user): void;
}
