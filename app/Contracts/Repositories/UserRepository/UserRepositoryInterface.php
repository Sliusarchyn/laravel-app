<?php

declare(strict_types=1);

namespace App\Contracts\Repositories\UserRepository;

use App\Contracts\Common\Dto\PaginationData;
use App\Models\User;
use App\ValueObjects\Email;
use App\ValueObjects\Phone;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface UserRepositoryInterface
{
    /**
     * @param PaginationData $paginationData
     * @return LengthAwarePaginator<User>
     */
    public function paginate(PaginationData $paginationData): LengthAwarePaginator;

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

    public function save(User $user): User;

    public function delete(User $user): void;
}
