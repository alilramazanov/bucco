<?php

namespace App\Http\Controllers\Control;

use App\Http\Controllers\Controller;
use App\Http\Requests\Control\Auth\LoginRequest;
use App\Http\Requests\Control\Auth\RegisterRequest;
use App\Http\Resources\Control\Auth\LoginResource;
use App\Http\Resources\Control\Auth\RegisterResource;
use App\Http\Resources\Control\Common\ErrorResource;
use App\Services\AuthService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Response;

class AuthController extends Controller
{

    protected AuthService $authService;

    public function __construct()
    {
        $this->authService = app(AuthService::class);
    }

    /**
     * @param RegisterRequest $request
     * @return ErrorResource|\Illuminate\Http\JsonResponse|object
     */
    public function register(RegisterRequest $request)
    {
        try {
            $admin = $this->authService->register($request->validated());

            if ($admin) {
                event(new Registered($admin));
            }
            return (new RegisterResource($admin))->response()->setStatusCode(Response::HTTP_CREATED);
        } catch (\Exception $exception) {
            return new ErrorResource($exception);
        }
    }


    /**
     * @param LoginRequest $request
     * @return LoginResource|\Illuminate\Http\JsonResponse|object
     */
    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->only(['login', 'password']);

            $token = $this->authService->login($credentials);
            $stdClass = new \StdClass();
            $stdClass->token = $token;

            return (new LoginResource($stdClass));
        } catch (\Exception $exception)
        {
            return (new ErrorResource($exception))->response()->setStatusCode(Response::HTTP_BAD_REQUEST);
        }
    }



    /**
     * @param LoginRequest $request
     * @return LoginResource|\Illuminate\Http\JsonResponse|object
     */
    public function loginMember(LoginRequest $request)
    {
        try {
            $credentials = $request->only(['login', 'password']);

            $token = $this->authService->loginMember($credentials);
            $stdClass = new \StdClass();
            $stdClass->token = $token;

            return (new LoginResource($stdClass));

        } catch (\Exception $exception)
        {
            return (new ErrorResource($exception))->response()->setStatusCode(Response::HTTP_BAD_REQUEST);
        }
    }
}
