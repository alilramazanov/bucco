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

//$router->get('/key', function() {
//    return \Illuminate\Support\Str::random(32);
//});

use Illuminate\Support\Facades\Route;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

//$router->get('/', function () use ($router) {
//    throw new \Symfony\Component\HttpFoundation\Exception\BadRequestException();
//});

$router->get('/image', 'Control\ImageController@show');


$router->group(
    ['prefix' => 'control/v1'],
    function (){
        Route::group(
            ['prefix' => 'groups'],
            function () {
                Route::get('/list', 'Control\GroupController@list');
                Route::get('/detail', 'Control\GroupController@detail');
                Route::get('/statistic-list', 'Control\GroupController@statisticList');
                Route::post('/create', 'Control\GroupController@create');
                Route::post('/update', 'Control\GroupController@update');
                Route::post('/delete', 'Control\GroupController@delete');
                Route::post('/add-member', 'Control\GroupController@addMember');
            }
        );

        Route::group(
            ['prefix' => 'tasks'],
            function (){
                Route::get('/group-task-list', 'Control\TaskController@groupTaskList');
                Route::get('/member-task-list', 'Control\TaskController@memberTaskList');
                Route::post('/create', 'Control\TaskController@create');
                Route::post('/update', 'Control\TaskController@update');
                Route::post('/delete', 'Control\TaskController@delete');

            }
        );

        Route::group(
            ['prefix' => 'members'],
            function (){
                Route::get('/admin-member-list','Control\MemberController@adminMemberList');
                Route::get('/group-member-list', 'Control\MemberController@groupMemberList');
                Route::get('/detail-group-member', 'Control\MemberController@detailGroupMember');
                Route::post('/update-group-member', 'Control\MemberController@updateGroupMember');
                Route::post('/create-member-in-group', 'Control\MemberController@create');
                Route::post('/create', 'Control\MemberController@createMember');
                Route::post('/unsert-member', 'Control\MemberController@unsert');
                Route::get('/detail', 'Control\MemberController@detail');
                Route::post('/update', 'Control\MemberController@update');
                Route::post('/delete', 'Control\MemberController@delete');

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
