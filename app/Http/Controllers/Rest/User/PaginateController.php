<?php

namespace App\Http\Controllers\Rest\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rest\User\PaginateRequest;
use App\Http\Resources\User\UserLessResource;
use App\Contracts\Common\Dto\PaginationData;
use App\Contracts\Services\UserService\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class PaginateController extends Controller
{
    public function __construct(private readonly UserServiceInterface $userService)
    {
    }

    public function __invoke(PaginateRequest $request): JsonResponse
    {
        $usersPage = $this->userService->paginate(new PaginationData(
            (int)$request->get('page', 1),
            (int)$request->get('per_page', 20)
        ));

        return UserLessResource::collection($usersPage->items())
            ->additional([
                'total' => $usersPage->total(),
                'current_page' => $usersPage->currentPage(),
                'last_page' => $usersPage->lastPage(),
                'per_page' => $usersPage->perPage()
            ])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
