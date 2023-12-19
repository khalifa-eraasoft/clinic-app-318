<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Resources\User\RegisterResource;
use Illuminate\Auth\Middleware\Authenticate;

class AuthController extends Controller
{
    use ApiResponseTrait;

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['role'] = 'patient';
        $data['status'] = 'active';
        $user = User::create($data);
        return $this->apiResponse(new RegisterResource($user), 'Register Successfully', [], 201);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $user = User::where('email', $data['email'])
            ->first();
        if (!$token = auth()->guard('api')->attempt($data)) {
            return $this->apiResponse([], "unauthorized", [], 401);
        }
        return $this->apiResponse([
            'user' => new RegisterResource($user),
            'token' => $token
        ], "login_successfully", [], 200);
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()
            ->logout();
        return $this->apiResponse([], 'Successfully logged out');
    }
}
