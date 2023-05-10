<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\ValueObjects\Phone;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $user = new User();
        $user->name = $request->get('name');
        $user->phone = Phone::fromString($request->get('phone'));
        $user->save();

        return new JsonResponse(status: Response::HTTP_CREATED);
    }
}
