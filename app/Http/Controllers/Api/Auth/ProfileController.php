<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\UpdateProfileRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class ProfileController extends AppBaseController
{
    public function profile()
    {
        $user = auth()->user();
        return $this->sendResponse(['user' => new UserResource($user)],'profile data get successfully');
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = auth()->user();
        $data = $request->only(['name', 'email']);
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);
        return $this->sendResponse(['user' => new UserResource($user)], 'profile updated successfully');
    }
}
