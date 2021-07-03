<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\v1\CommentController;
use App\Http\Controllers\Api\v1\PostController;
use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\PostRelationShipController;
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

    Route::get('/posts/{post}/relationships/author',[PostRelationShipController::class,'author'])->name('posts.relationships.author');
    Route::get('/posts/{post}/author',[PostRelationShipController::class,'author'])->name('posts.author');

    Route::get('/posts/{post}/relationships/comments',[PostRelationShipController::class,'comments'])->name('posts.relationships.comments');
    Route::get('/posts/{post}/comments',[PostRelationShipController::class,'comments'])->name('posts.comments');

    Route::apiResource('users', UserController::class);
    Route::apiResource('comments', CommentController::class);
});

Route::post('login', [AuthController::class,'login']);
Route::post('signup', [AuthController::class,'signup']);