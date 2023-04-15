<?php

namespace App\Http\Controllers\Rest\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

final class DeleteController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse();
    }
}
