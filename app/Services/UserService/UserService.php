<?php

declare(strict_types=1);

namespace App\Services\UserService;

use App\Contracts\Services\UserService\UserServiceInterface;
use App\Models\User;
use App\ValueObjects\Phone;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use LogicException;

class UserService implements UserServiceInterface
{
    public function __construct(private readonly User $user)
    {
    }

    /**
     * @param int $userId
     * @return User
     * @throws ModelNotFoundException
     */
    public function findById(int $userId): User
    {
        //TODO: I prefer to use the Repository pattern for this, but that's a topic for a separate article
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->user->newQuery()
            ->findOrFail($userId);
    }

    /**
     * @param Phone $phone
     * @return User
     * @throws ModelNotFoundException
     */
    public function findByPhone(Phone $phone): User
    {
        //TODO: I prefer to use the Repository pattern for this, but that's a topic for a separate article
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->user->newQuery()
            ->where('phone', '=', $phone->toString())
            ->firstOrFail();
    }

    /**
     * @throws LogicException
     */
    public function create(string $name, Phone $phone): User
    {
        try {
            $this->findByPhone($phone);
            throw new LogicException('User with this phone already exists!');//I recommend to use separate Exception for specific case
        } catch (ModelNotFoundException $e) {
        }

        $user = new User();

        $user->name = $name;
        $user->phone = $phone;
        $user->save();

        //Some mandatory logic when creating a user

        return $user;
    }

    /**
     * @param int $id
     * @return void
     * @throws ModelNotFoundException
     */
    public function deleteById(int $id): void
    {
        //TODO: I prefer to use the Repository pattern for this, but that's a topic for a separate article
        $user = $this->findById($id);
        $user->delete();
    }
}
