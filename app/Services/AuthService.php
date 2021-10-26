<?php

namespace App\Services;

use App\Http\Requests\Control\Auth\UpdateProfileRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

final class AuthService
{

    /**
     * @param array $request
     * @return Admin
     */
    public function register(array $validated): Admin
    {
        $admin = new Admin;
        $admin->name = $validated['name'];
        $admin->login = $validated['login'];
        $basePassword = $validated['password'];
        $admin->password = app('hash')->make($basePassword);

        $admin->save();

        return $admin;
    }

    /**
     * @param array $validated
     * @return string
     */
    public function login(array $validated): string
    {
        if (!$token = Auth::attempt($validated)) {
            throw new \DomainException('Неверный логин или пароль');
        }

        return $token;
    }

    /**
     * @param array $validated
     * @return string
     */
    public function loginMember(array $validated): string
    {
        if (!$token = Auth::guard('member')->attempt($validated)) {
            throw new \DomainException('Неверный логин или пароль');
        }

        return $token;
    }

    /**
     * @param UpdateProfileRequest $request
     * @return mixed
     */
    public function update(UpdateProfileRequest $request)
    {
        $admin = Auth::user();

        $admin->update($request->validated());

        return $admin;
    }

}
