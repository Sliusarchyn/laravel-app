<?php

declare(strict_types=1);

namespace App\Repositories\UserRepository;

use App\Contracts\Common\Dto\PaginationData;
use App\Contracts\Repositories\UserRepository\UserRepositoryInterface;
use App\Models\User;
use App\ValueObjects\Phone;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(private readonly User $model)
    {
    }

    /**
     * @param PaginationData $paginationData
     * @return LengthAwarePaginator<User>
     */
    public function paginate(PaginationData $paginationData): LengthAwarePaginator
    {
        return $this->model
            ->newQuery()
            ->paginate($paginationData->perPage, ['*'], 'page', $paginationData->page);
    }

    /**
     * @param int $id
     * @return User
     * @throws ModelNotFoundException
     */
    public function findById(int $id): User
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->model
            ->newQuery()
            ->findOrFail($id);
    }

    /**
     * @param Phone $phone
     * @return User
     * @throws ModelNotFoundException
     */
    public function findByPhone(Phone $phone): User
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->model
            ->newQuery()
            ->where('email', '=', $phone->toString())
            ->firstOrFail();
    }

    public function save(User $user): User
    {
        $user->save();

        return $user;
    }

    public function delete(User $user): void
    {
        $user->delete();
    }
}
