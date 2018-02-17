<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->get('posts', 'App\Http\Controllers\PostsController@index');
    $api->post('authenticate', 'App\Http\Controllers\AuthenticateController@authenticate');
    $api->post('logout', 'App\Http\Controllers\AuthenticateController@logout');
    $api->get('token/refresh', 'App\Http\Controllers\AuthenticateController@refreshToken');
});

$api->version('v1', ['middleware' => 'api.auth'], function ($api) {
    $api->get('user', 'App\Http\Controllers\AuthenticateController@authenticatedUser');
    $api->post('posts', 'App\Http\Controllers\PostsController@store');
});
