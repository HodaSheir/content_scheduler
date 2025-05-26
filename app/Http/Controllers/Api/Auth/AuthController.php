<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends AppBaseController
{
    public function Register(RegisterRequest $request)
    {
        $user = User::create($request->validated());
        if ($user) {
            $token = $user->createToken('content-scheduler')->plainTextToken;
            return $this->sendResponse(['user' => new UserResource($user), 'token' => $token], 'registered successfully');
        }
        return $this->sendError('something went wrong', 422);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return $this->sendError('user not found', 422);
        }
        Auth::user()->tokens()->delete();
        return response()->json([
            'token' => Auth::user()->createToken('content-scheduler')->plainTextToken,
        ]);
    }

    public function logout()
    {
        $user = Auth::user();
        $user->currentAccessToken()->delete();
        return $this->sendSuccess('user logged out successfully');
    }
}
