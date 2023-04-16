<?php

declare(strict_types=1);

namespace App\Services\UserService;

use App\Contracts\Common\Dto\PaginationData;
use App\Contracts\Repositories\UserRepository\UserRepositoryInterface;
use App\Contracts\Services\UserService\Dto\CreateData;
use App\Contracts\Services\UserService\UserServiceInterface;
use App\Exceptions\UserAlreadyExistsException;
use App\Models\User;
use App\ValueObjects\Email;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserService implements UserServiceInterface
{
    public function __construct(private readonly UserRepositoryInterface $userRepository)
    {
    }

    public function paginate(PaginationData $paginationData): LengthAwarePaginator
    {
        return $this->userRepository->paginate($paginationData);
    }

    public function findById(int $id): User
    {
        return $this->userRepository->findById($id);
    }

    /**
     * @throws UserAlreadyExistsException
     */
    public function create(CreateData $createData): User
    {
        try {
            $this->userRepository->findByEmail($createData->email);
            throw new UserAlreadyExistsException('User with this email already exists!');
        } catch (ModelNotFoundException $e) {
        }

        $user = new User();

        $user->email = $createData->email->toString();
        $user->name = $createData->name;
        $user->phone = $createData->phone->toString();

        return $this->userRepository->save($user);
    }

    public function deleteById(int $id): void
    {
        $user = $this->userRepository->findById($id);
        $this->userRepository->delete($user);
    }

    /**
     * @param Email $email
     * @throws ModelNotFoundException
     */
    public function deleteByEmail(Email $email): void
    {
        $user = $this->userRepository->findByEmail($email);
        $this->userRepository->delete($user);
    }
}
