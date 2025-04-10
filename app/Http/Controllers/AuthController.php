<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Register a user
     *
     * @unauthenticated
     * @param UserRegisterRequest $request
     * @return JsonResponse
     */
    public function register(UserRegisterRequest $request) : JsonResponse
    {
        $user = app(UserRepositoryInterface::class)->create($request->validated());
        $token = $user->createToken('token')->plainTextToken;
        return response()->json([
            'status' => true,
            'token' => $token
        ],  Response::HTTP_CREATED);
    }


    /**
     * Login User
     *
     * @unauthenticated
     * @param UserLoginRequest $request
     * @return JsonResponse
     */
    public function login(UserLoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Incorrect Password'
            ], Response::HTTP_UNAUTHORIZED);
        }
        $token = $user->createToken('token')->plainTextToken;
        return response()->json([
            'status' => true,
            'token' => $token
        ], Response::HTTP_OK);
    }
}
