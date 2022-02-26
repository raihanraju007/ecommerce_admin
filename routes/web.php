<?php

use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', [AuthenticatedSessionController::class, 'create']);


Route::get('/', [
    'uses'          => 'App\Http\Controllers\LoginController@index',
    'as'            => '/',
    'middleware'    => ['guest:'.config('fortify.guard')]

]);

Route::get('/dashboard', [
    'uses'          => 'App\Http\Controllers\DashboardController@index',
    'as'            => 'dashboard',
    'middleware'    => ['auth:sanctum', 'verified']
]);

// Category Controller

Route::get('/manage-category', [
    'uses'          => 'App\Http\Controllers\CategoryController@index',
    'as'            => 'manage-category',
    'middleware'    => ['auth:sanctum', 'verified']
]);

Route::post('/new-category', [
    'uses'          => 'App\Http\Controllers\CategoryController@create',
    'as'            => 'new-category',
    'middleware'    => ['auth:sanctum', 'verified']
]);

Route::get('/update-category-status/{id}', [
    'uses'          => 'App\Http\Controllers\CategoryController@updateStatus',
    'as'            => 'update-category-status',
    'middleware'    => ['auth:sanctum', 'verified']
]);

Route::get('/edit-category/{id}', [
    'uses'          => 'App\Http\Controllers\CategoryController@edit',
    'as'            => 'edit-category',
    'middleware'    => ['auth:sanctum', 'verified']
]);

Route::post('/update-category', [
    'uses'          => 'App\Http\Controllers\CategoryController@update',
    'as'            => 'update-category',
    'middleware'    => ['auth:sanctum', 'verified']
]);

Route::get('/delete-category/{id}', [
    'uses'          => 'App\Http\Controllers\CategoryController@delete',
    'as'            => 'delete-category',
    'middleware'    => ['auth:sanctum', 'verified']
]);

// Sub Category Controller

Route::resource('sub-category', SubCategoryController::class);



// Brand Controller

Route::get('/manage-brand', [
    'uses'          => 'App\Http\Controllers\BrandController@index',
    'as'            => 'manage-brand',
    'middleware'    => ['auth:sanctum', 'verified']
]);

//Video 44 minutes 06




