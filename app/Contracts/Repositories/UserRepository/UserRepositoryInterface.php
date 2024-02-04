<?php

declare(strict_types=1);

namespace App\Contracts\Repositories\UserRepository;

use App\Contracts\Common\Dto\PaginationData;
use App\Contracts\Repositories\UserRepository\Dto\Filter;
use App\Contracts\Repositories\UserRepository\Dto\UserPaginatedData;
use App\Exceptions\User\UserNotFoundException;
use App\Models\User;
use App\ValueObjects\Phone;

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
     * @throws UserNotFoundException
     */
    public function findById(int $id): User;

    /**
     * @param Phone $phone
     * @return User
     * @throws UserNotFoundException
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
