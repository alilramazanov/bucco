<?php

namespace App\Http\Controllers\Control;

use App\Http\Controllers\Controller;
use App\Http\Requests\Control\Auth\UpdatePasswordRequest;
use App\Http\Requests\Control\Auth\UpdateProfileRequest;
use App\Http\Resources\Control\Auth\LoginResource;
use App\Http\Resources\Control\Auth\RegisterResource;
use App\Http\Resources\Control\Common\ErrorResource;
use App\Http\Resources\Control\Common\SuccessResource;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    protected AuthService $authService;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->authService = app(AuthService::class);
        $this->middleware('auth:admin');
    }

    /**
     * @param Request $request
     * @return RegisterResource
     */
    public function showAdmin(Request $request): RegisterResource
    {
        return new RegisterResource($request->user());
    }

    /**
     * @param UpdateProfileRequest $request
     * @return RegisterResource|ErrorResource
     */
    public function updateAdmin(UpdateProfileRequest $request)
    {
        try {
            $admin = $this->authService->update($request);

            return new RegisterResource($admin);
        } catch (\Exception $exception) {
            return new ErrorResource($exception);
        }
    }

    public function changePassword(UpdatePasswordRequest $request)
    {
        try {
            $stdClass = new \stdClass();
            $admin = \Auth::user();

            $admin->password = app('hash')->make($request->get('newPassword'));
            $admin->save();

            $stdClass->message = 'Пароль успешно изменён';

            return new SuccessResource($stdClass);
        } catch (\Exception $exception) {
            return new ErrorResource($exception);
        }
    }

    /**
     * @return ErrorResource|SuccessResource
     */
    public function logout()
    {
        try {
            $stdClass = new \stdClass();
            \Auth::logout();
            $stdClass->message = 'Успешно';

            return new SuccessResource($stdClass);
        } catch (\Exception $exception) {
            return new ErrorResource($exception);
        }
    }

    /**
     * @return LoginResource
     */
    public function refresh(): LoginResource
    {
        $stdClass = new \stdClass();
        $stdClass->token = Auth::refresh();
        return new LoginResource($stdClass);
    }
}
