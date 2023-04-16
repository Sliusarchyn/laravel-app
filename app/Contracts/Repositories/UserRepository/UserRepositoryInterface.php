<?php

declare(strict_types=1);

namespace App\Contracts\Repositories\UserRepository;

use App\Contracts\Common\Dto\PaginationData;
use App\Models\User;
use App\ValueObjects\Email;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface UserRepositoryInterface
{
    public function paginate(PaginationData $paginationData): LengthAwarePaginator;

    /**
     * @param int $id
     * @return User
     * @throws ModelNotFoundException
     */
    public function findById(int $id): User;

    /**
     * @param Email $email
     * @return User
     * @throws ModelNotFoundException
     */
    public function findByEmail(Email $email): User;

    public function save(User $user): User;

    public function delete(User $user): void;
}
