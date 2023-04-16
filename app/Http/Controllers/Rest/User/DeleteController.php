<?php

namespace App\Http\Controllers\Rest\User;

use App\Http\Controllers\Controller;
use App\Contracts\Services\UserService\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class DeleteController extends Controller
{
    public function __construct(private readonly UserServiceInterface $userService)
    {
    }

    public function __invoke(int $id): JsonResponse
    {
        $this->userService->deleteById($id);

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
