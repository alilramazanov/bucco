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
            function () {
                Route::get('/list', 'Control\GroupController@list');
                Route::get('/statistic-list', 'Control\GroupController@statisticList');

            }
        );

        Route::group(
            ['prefix' => 'tasks'],
            function (){
                Route::get('/group-task-list', 'Control\TaskController@groupTaskList');
                Route::get('/member-task-list', 'Control\TaskController@memberTaskList');


                Route::post('/task-create', 'Control\TaskController@create');
                Route::post('/task-update', 'Control\TaskController@update');
                Route::post('/task-delete', 'Control\TaskController@delite');

            }
        );

        Route::group(
            ['prefix' => 'members'],
            function (){
                Route::get('admin-member-list','Control\MemberController@adminMemberList');
                Route::get('group-member-list', 'Control\MemberController@groupMemberList');

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
