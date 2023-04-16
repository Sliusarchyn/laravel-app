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
        return UserResource::make($this->userService->findById($id))->response();
    }
}
