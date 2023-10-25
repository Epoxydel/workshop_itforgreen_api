<?php

namespace App\Http\Controllers;

use App\Exceptions\CreateUserException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User as UserModel;
use Illuminate\Validation\ValidationException;

class User extends Controller
{
    function login(Request $request): JsonResponse
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = UserModel::where('email', $email)->first();

        if ($user && password_verify($password, $user->password)) {
            return response()->json(['message' => 'Connexion réussie']);
        } else {
            return response()->json(['message' => 'Échec de la connexion'], 401);
        }
    }
}
