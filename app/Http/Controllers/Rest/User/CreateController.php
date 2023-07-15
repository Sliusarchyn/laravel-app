<?php

declare(strict_types=1);

namespace App\Http\Controllers\Rest\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rest\User\CreateRequest;
use App\Contracts\Services\UserService\UserServiceInterface;
use App\ValueObjects\Phone;
use DateTimeInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class CreateController extends Controller
{
    public function __construct(private readonly UserServiceInterface $userService)
    {
    }

    public function __invoke(CreateRequest $request): JsonResponse
    {
        $name = $request->get('name');
        $phone = Phone::fromString($request->get('phone'));

        $user = $this->userService->create($name, $phone);

        return new JsonResponse([
            'id' => $user->id,
            'name' => $user->name,
            'phone' => $user->phone->toString(),
            'created_at' => $user->created_at->format(DateTimeInterface::ATOM),
        ], Response::HTTP_CREATED);
    }
}
