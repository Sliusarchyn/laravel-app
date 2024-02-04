<?php

namespace App\Http\Controllers\Rest\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Contracts\Services\UserService\UserServiceInterface;
use Illuminate\Http\JsonResponse;

final class ShowController extends Controller
{
    public function __construct(private readonly UserServiceInterface $userService)
    {
    }

    public function __invoke(int $id): JsonResponse
    {
        $user = $this->userService->findById($id);

        return UserResource::make($user)->response();
    }
}
