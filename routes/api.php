<?php

use Dingo\Api\Routing\Router;

$api = app(Router::class);

$api->version('v1', ['namespace' => 'App\Api\V1\Controllers'], function (Router $api) {
    // ====== public routes ======
    $api->group(['prefix' => 'auth'], function (Router $api) {
        $api->post('register', 'AuthController@register');
        $api->post('login', 'AuthController@login');
        $api->post('logout', 'AuthController@logout');
        $api->post('refresh', 'AuthController@refresh');
        $api->get('captcha', 'AuthController@captcha');
        $api->get('me', 'AuthController@me');
    });

    // ====== protected routes ======
    $api->group(['middleware' => 'jwt.auth'], function (Router $api) {
        $api->get('protected', function () {
            return response()->json([
                'message' => 'Access to protected resources granted! You are seeing this text as you provided the token correctly.'
            ]);
        });
    });

    // ====== public routes ======
    $api->get('hello', function () {
        return response()->json([
            'message' => 'This is a simple example of item returned by your APIs. Everyone can see it.'
        ]);
    });
});
