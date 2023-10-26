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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['middleware' => 'cors'], function () use ($router) {
    $router->post('/api/user', 'User@login');
    $router->post('/api/organization', 'Organization@index');
    $router->post('/api/organization/type', 'Organization@allType');
    $router->post('/api/organization/{id}', 'Organization@getOrganization');
    $router->post('/api/event', 'Event@index');
    $router->post('/api/event/{id}', 'Event@getEvent');
});

