<?php

namespace App\Http\Controllers\Rest\User;

use App\Exceptions\UserAlreadyExistsException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Rest\User\CreateRequest;
use App\Http\Resources\User\UserResource;
use App\Contracts\Services\UserService\Dto\CreateData;
use App\Contracts\Services\UserService\UserServiceInterface;
use App\ValueObjects\Email;
use App\ValueObjects\Phone;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class CreateController extends Controller
{
    public function __construct(private readonly UserServiceInterface $userService)
    {
    }

    /**
     * @throws UserAlreadyExistsException
     */
    public function __invoke(CreateRequest $request): JsonResponse
    {
        $data = new CreateData(
            Email::fromString($request->get('email')),
            $request->get('name'),
            Phone::fromString($request->get('phone'))
        );

        return UserResource::make($this->userService->create($data))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
