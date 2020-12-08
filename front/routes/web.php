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
	return response()->json(["Message" => 'Welcome to Frontend Services.']);
});

$router->group(['prefix' => 'search'] , function($router){
	$router->get('{topic}','FrontController@getBooks');
});

$router->group(['prefix' => 'lookup'] , function($router){
	$router->get('{id}','FrontController@getBook');
});