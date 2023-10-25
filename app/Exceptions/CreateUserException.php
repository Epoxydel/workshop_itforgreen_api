<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class CreateUserException extends ValidationException
{
    protected function invalidJson($request, $errors): JsonResponse
    {
        return new JsonResponse(['error' => $errors], 422);
    }
}
