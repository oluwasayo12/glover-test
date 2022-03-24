<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public $auth_service;
    
    /**
     * __construct
     *
     * @param  mixed $auth_service
     * @return void
     */
    public function __construct(AuthService $auth_service)
    {
        $this->auth_service = $auth_service;
    }
    
    /**
     * login
     *
     * @param  mixed $request
     * @return Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {

        $input = $request->validated();
        $credentials = $this->auth_service->login($input);
        if (!$credentials['status']) {
            return $this->badRequestAlert('Invalid username or password');
        }

        $response = [
            'user' => $credentials['data']['user'],
            'access_token' => $credentials['data']['token'],
            'token_type' => 'Bearer'
        ];
        return $this->successResponse("login successful", $response);
    }
    
    /**
     * logout
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function logout(): \Illuminate\Http\JsonResponse
    {
        auth()->user()->tokens()->delete();
        return $this->successResponse("logout successful");
    }
}
