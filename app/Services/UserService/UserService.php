<?php

declare(strict_types=1);

namespace App\Services\UserService;

use App\Contracts\Common\Dto\PaginationData;
use App\Contracts\Repositories\UserRepository\Dto\Filter;
use App\Contracts\Repositories\UserRepository\UserRepositoryInterface;
use App\Contracts\Services\UserService\Dto\CreationData;
use App\Contracts\Services\UserService\Dto\UpdateData;
use App\Contracts\Services\UserService\UserServiceInterface;
use App\Models\User;
use App\Repositories\UserRepository\Dto\UserPaginatedData;
use App\ValueObjects\Phone;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use LogicException;

class UserService implements UserServiceInterface
{
    public function __construct(private readonly UserRepositoryInterface $userRepository)
    {
    }

    /**
     * @param PaginationData $paginationData
     * @param Filter|null $filter
     * @return UserPaginatedData
     */
    public function paginate(PaginationData $paginationData, ?Filter $filter = null): UserPaginatedData
    {
        return $this->userRepository->paginate($paginationData, $filter);
    }

    /**
     * @param int $userId
     * @return User
     * @throws ModelNotFoundException
     */
    public function findById(int $userId): User
    {
        return $this->userRepository->findById($userId);
    }

    /**
     * @throws LogicException
     */
    public function create(CreationData $data): User
    {
        try {
            $this->userRepository->findByPhone($data->phone);
            throw new LogicException('User with this phone already exists!');
        } catch (ModelNotFoundException $e) {
        }

        $user = new User();

        $user->name = $data->name;
        $user->phone = $data->phone;

        return $this->userRepository->save($user);
    }

    public function update(int $id, UpdateData $data): User
    {
        $user = $this->userRepository->findById($id);

        $user->name = $data->name ?? $user->name;

        if (null !== $data->phone) {
            try {
                $userWithPhone = $this->userRepository->findByPhone($data->phone);

                if ($userWithPhone->id !== $id) {
                    throw new LogicException('User with this phone already exists!');
                }
            } catch (ModelNotFoundException $e) {
            }

            $user->phone = $data->phone;
        }

        return $this->userRepository->save($user);
    }


    /**
     * @param int $id
     * @return void
     * @throws ModelNotFoundException
     */
    public function deleteById(int $id): void
    {
        $user = $this->userRepository->findById($id);

        $this->userRepository->delete($user);
    }

    /**
     * @param Phone $phone
     * @return void
     */
    public function deleteByPhone(Phone $phone): void
    {
        $user = $this->userRepository->findByPhone($phone);

        $this->userRepository->delete($user);
    }
}
