<?php

declare(strict_types=1);

namespace App\Repositories\UserRepository;

use App\Contracts\Common\Dto\PaginationData;
use App\Contracts\Repositories\UserRepository\Dto\Filter;
use App\Contracts\Repositories\UserRepository\Dto\UserPaginatedData;
use App\Contracts\Repositories\UserRepository\UserRepositoryInterface;
use App\Exceptions\User\UserNotFoundException;
use App\Models\User;
use App\ValueObjects\Phone;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;

readonly class UserRepository implements UserRepositoryInterface
{
    public function __construct(private User $model)
    {
    }

    /**
     * @param PaginationData $paginationData
     * @param Filter|null $filter
     * @return UserPaginatedData
     */
    public function paginate(PaginationData $paginationData, ?Filter $filter = null): UserPaginatedData
    {
        $query = $this->model->newQuery();

        if (null !== $filter) {
            $query = $this->parseFilterForQuery($query, $filter);
        }

        $paginatedData = $query->paginate($paginationData->perPage, ['*'], 'page', $paginationData->page);

        return new UserPaginatedData(
            $paginatedData->items(),
            $paginatedData->currentPage(),
            $paginatedData->perPage(),
            $paginatedData->total()
        );
    }

    /**
     * @param int $id
     * @return User
     * @throws UserNotFoundException
     */
    public function findById(int $id): User
    {
        try {
            /** @noinspection PhpIncompatibleReturnTypeInspection */
            return $this->model
                ->newQuery()
                ->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new UserNotFoundException($e->getMessage());
        }
    }

    /**
     * @param Phone $phone
     * @return User
     * @throws UserNotFoundException
     */
    public function findByPhone(Phone $phone): User
    {
        try {
            /** @noinspection PhpIncompatibleReturnTypeInspection */
            return $this->model
                ->newQuery()
                ->where('phone', '=', $phone->toString())
                ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            throw new UserNotFoundException($e->getMessage());
        }
    }

    /**
     * @param User $user
     * @return User
     */
    public function save(User $user): User
    {
        $user->save();

        return $user;
    }

    /**
     * @param User $user
     * @return void
     */
    public function delete(User $user): void
    {
        $user->delete();
    }

    /**
     * @param Builder $query
     * @param Filter $filter
     * @return Builder
     */
    protected function parseFilterForQuery(Builder $query, Filter $filter): Builder
    {
        return $query->when(null !== $filter->name, function (Builder $query) use ($filter) {
            $name = strtolower($filter->name);

            return $query->whereRaw('LOWER(name) LIKE ?', "%$name%");
        })->when(null !== $filter->phone, function (Builder $query) use ($filter) {
            return $query->where('phone', 'LIKE', "%{$filter->phone}%");
        });
    }
}
