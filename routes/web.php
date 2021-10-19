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
    return "next door";
//    return $router->app->version();
});

$router->group(
    ['prefix' => 'control/v1'],
    function (){
        Route::group(
            ['prefix' => 'groups','as' => 'groups.'],
            function (){
                Route::get('/list', 'Control\GroupController@list');

            }
        );

        Route::group(
            ['prefix' => 'tasks', 'as' => 'tasks.'],
            function (){
                Route::get('/all_group_tasks', 'Control\TaskController@getAllGroupTasks');
            }
        );

        Route::group(
            ['prefix' => 'members', 'as' => 'members.'],
            function (){
                Route::get('/all_group_members', 'Control\Member@getAllGroupMembers');
            }
        );
    }
);
