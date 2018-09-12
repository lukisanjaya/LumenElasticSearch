<?php

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

// $app->get('/', function () use ($app) {
//     return $app->version();
// });

// $app->group(['prefix' => 'api'], function () use ($app) {
//     $app->get('blogs',  ['uses' => 'BlogController@showAllBlogs']);
  
//     $app->get('blogs/{slug}', ['uses' => 'BlogController@showOneBlog']);

//     $app->get('category_blogs/{slug}', ['uses' => 'BlogController@byCategory']);
  
//     $app->post('blogs', ['uses' => 'BlogController@create']);
  
//     $app->delete('blogs/{id}', ['uses' => 'BlogController@delete']);
  
//     $app->put('blogs/{id}', ['uses' => 'BlogController@update']);

//     $app->get('categories',  ['uses' => 'CategoryController@showAllCategories']);
  
//     $app->get('categories/{id}', ['uses' => 'CategoryController@showOneCategory']);
  
//     $app->post('categories', ['uses' => 'CategoryController@create']);
  
//     $app->delete('categories/{id}', ['uses' => 'CategoryController@delete']);
  
//     $app->put('categories/{id}', ['uses' => 'CategoryController@update']);
// });


$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->get('blogs',  ['uses' => 'App\Http\Controllers\BlogController@showAllBlogs']);
  
    $api->get('blogs/{slug}', ['uses' => 'App\Http\Controllers\BlogController@showOneBlog']);

    $api->get('category_blogs/{slug}', ['uses' => 'App\Http\Controllers\BlogController@byCategory']);
  
    $api->post('blogs', ['uses' => 'App\Http\Controllers\BlogController@create']);
  
    $api->delete('blogs/{id}', ['uses' => 'App\Http\Controllers\BlogController@delete']);
  
    $api->put('blogs/{id}', ['uses' => 'App\Http\Controllers\BlogController@update']);

    $api->get('categories',  ['uses' => 'App\Http\Controllers\CategoryController@showAllCategories']);
  
    $api->get('categories/{id}', ['uses' => 'App\Http\Controllers\CategoryController@showOneCategory']);
  
    $api->post('categories', ['uses' => 'App\Http\Controllers\CategoryController@create']);
  
    $api->delete('categories/{id}', ['uses' => 'App\Http\Controllers\CategoryController@delete']);
  
    $api->put('categories/{id}', ['uses' => 'App\Http\Controllers\CategoryController@update']);
});