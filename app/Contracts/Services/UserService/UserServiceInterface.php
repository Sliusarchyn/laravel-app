<?php

declare(strict_types=1);

namespace App\Contracts\Services\UserService;

use App\Contracts\Common\Dto\PaginationData;
use App\Contracts\Services\UserService\Dto\CreateData;
use App\Exceptions\UserAlreadyExistsException;
use App\Models\User;
use App\ValueObjects\Email;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface UserServiceInterface
{
    public function paginate(PaginationData $paginationData): LengthAwarePaginator;

    /**
     * @param int $id
     * @return User
     * @throws ModelNotFoundException
     */
    public function findById(int $id): User;

    /**
     * @throws UserAlreadyExistsException
     */
    public function create(CreateData $createData): User;

    /**
     * @param int $id
     * @return void
     * @throws ModelNotFoundException
     */
    public function deleteById(int $id): void;

    /**
     * @param Email $email
     * @throws ModelNotFoundException
     */
    public function deleteByEmail(Email $email): void;
}
