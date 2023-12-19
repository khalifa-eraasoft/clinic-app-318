<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Profile\UpdatePasswordRequest;
use App\Http\Requests\Api\Profile\UpdateProfileRequest;
use App\Http\Resources\User\RegisterResource;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    use ApiResponseTrait;

    public function updateProfile(UpdateProfileRequest $request)
    {
        auth('api')->user()
            ->update($request->validated());
        return $this->apiResponse(new RegisterResource(auth('api')->user()));
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['new_password']);
        auth('api')->user()
            ->update(['password' => $data['password']]);
        return $this->apiResponse(new RegisterResource(auth('api')->user()), 'Password Updated Success');
    }
}
