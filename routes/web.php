<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
//
//$router->get('/key', function() {
//    return \Illuminate\Support\Str::random(32);
//});

use Illuminate\Support\Facades\Route;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(
    ['prefix' => 'control/v1'],
    function (){
        Route::group(
            ['prefix' => 'groups'],
            function (){
                Route::get('/list', 'Control\GroupController@list');

            }
        );

        Route::group(
            ['prefix' => 'tasks'],
            function (){
                Route::get('/all_group_tasks', 'Control\TaskController@getAllGroupTasks');
            }
        );

        Route::group(
            ['prefix' => 'members'],
            function (){
                Route::get('/all_group_members', 'Control\Member@getAllGroupMembers');
            }
        );

        Route::group(
            ['prefix' => 'admin'],
            function (){
                Route::post('/register', 'Control\AuthController@register');
                Route::post('/login', 'Control\AuthController@login');
                Route::post('/logout', 'Control\ProfileController@logout');
                Route::get('/profile/show', 'Control\ProfileController@showAdmin');
                Route::post('/profile/update', 'Control\ProfileController@updateAdmin');
                Route::post('/refresh-token', 'Control\ProfileController@refresh');
                Route::post('/profile/change-password', 'Control\ProfileController@changePassword');
            }
        );

        Route::group(
            ['prefix' => 'member'],
            function (){
                Route::post('/login', 'Control\AuthController@loginMember');
                Route::post('/logout', 'Control\MemberProfileController@logout');
                Route::get('/profile/show', 'Control\MemberProfileController@show');
                Route::post('/refresh-token', 'Control\MemberProfileController@refresh');
            }
        );
    }
);
