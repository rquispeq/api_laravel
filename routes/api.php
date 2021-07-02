<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\v1\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    "prefix" => 'v1',
    'middleware' => ['auth:api']
],function(){
    Route::apiResource('posts',PostController::class);
});

Route::post('login', [AuthController::class,'login']);
Route::post('signup', [AuthController::class,'signup']);