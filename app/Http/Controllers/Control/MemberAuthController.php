<?php

namespace App\Http\Controllers\Control;

use App\Http\Controllers\Controller;
use App\Services\AuthService;

class MemberAuthController extends Controller
{

    protected AuthService $authService;

    public function __construct()
    {
        $this->authService = app(AuthService::class);
    }

    public function login()
    {

    }
}
