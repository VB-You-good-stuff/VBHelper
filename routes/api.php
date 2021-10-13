<?php

use App\Http\Controllers\MembersController;
use App\Http\Controllers\GuestbookController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\RespondController;
use App\Http\Controllers\DocumentController;
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


Route::group([
    'middleware' => 'api',
],function($router){
    //會員
    Route::post('/members',[MembersController::class,'register']);

    Route::post('/login',[MembersController::class,'login']);
    Route::post('/logout',[MembersController::class,'logout']);
    //文章的管理
    Route::post('/guestbooks',[GuestbookController::class,'create']);
    Route::put('/guestbooks',[GuestbookController::class,'edit']);
    Route::delete('/guestbooks',[GuestbookController::class,'delete']);
    //文章下的樓層
    Route::post('/contents',[ContentController::class,'create']);
    Route::put('/contents',[ContentController::class,'edit']);
    //樓層下的回覆
    Route::post('/responds',[RespondController::class,'create']);
    Route::put('/responds',[RespondController::class,'edit']);
    //教材文檔
    Route::post('/documents',[DocumentController::class,'create']);
    Route::get('/documents',[DocumentController::class,'get_all']);
});
//不用登入就可以做的事情
Route::get('/members',[MembersController::class,'getaccount']);
Route::get('/guestbooks',[GuestbookController::class,'get_all']);
Route::get('/guestbooks/{id}',[GuestbookController::class,'get_id']);
Route::get('/contents',[ContentController::class,'get_all']);
Route::get('/responds',[RespondController::class,'get_all']);
Route::get('/documents/{id}',[DocumentController::class,'get_id']);