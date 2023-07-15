<?php

declare(strict_types=1);

namespace App\Contracts\Services\UserService;

use App\Models\User;
use App\ValueObjects\Phone;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use LogicException;

interface UserServiceInterface
{
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
