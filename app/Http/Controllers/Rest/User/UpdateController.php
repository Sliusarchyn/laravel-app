<?php

namespace App\Http\Controllers\Rest\User;

use App\Contracts\Services\UserService\Dto\UpdateData;
use App\Http\Controllers\Controller;
use App\Contracts\Services\UserService\UserServiceInterface;
use App\Http\Requests\Rest\User\UpdateRequest;
use App\Http\Resources\User\UserResource;
use App\ValueObjects\Phone;
use Illuminate\Http\JsonResponse;

final class UpdateController extends Controller
{
    public function __construct(private readonly UserServiceInterface $userService)
    {
    }

    public function __invoke(int $id, UpdateRequest $request): JsonResponse
    {
        if ($request->has('phone')) {
            $phone = Phone::fromString($request->get('phone'));
        } else {
            $phone = null;
        }

        $user = $this->userService->update(
            $id,
            new UpdateData(
                $request->get('name'),
                $phone,
            )
        );

        return UserResource::make($user)->response();
    }
}
