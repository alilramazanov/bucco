<?php

namespace App\Http\Controllers\Control;

use App\Http\Controllers\Controller;
use App\Http\Resources\Control\Auth\LoginResource;
use App\Http\Resources\Control\Auth\ShowMemberResource;
use App\Http\Resources\Control\Common\ErrorResource;
use App\Http\Resources\Control\Common\SuccessResource;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberProfileController extends Controller
{

    /**
     * @var AuthService|\Laravel\Lumen\Application|mixed
     */
    protected AuthService $authService;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->authService = app(AuthService::class);
        $this->middleware('auth:member');
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

    /**
     * @param Request $request
     * @return ShowMemberResource
     */
    public function show(Request $request): ShowMemberResource
    {
        return new ShowMemberResource($request->user('member'));
    }

}
