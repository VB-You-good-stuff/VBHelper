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
    Route::get('/members',[MembersController::class,'getaccount']);//取得會員資料
    Route::post('/members',[MembersController::class,'register']);//註冊
    Route::post('/login',[MembersController::class,'login']);//登入
    Route::post('/logout',[MembersController::class,'logout']);//登出
    //文章
    Route::post('/guestbooks',[GuestbookController::class,'create']);//新增文章
    Route::put('/guestbooks',[GuestbookController::class,'edit']);//修改文章
    Route::delete('/guestbooks',[GuestbookController::class,'delete']);//刪除文章
    //回覆
    Route::post('/contents',[ContentController::class,'create']);//新增回覆
    Route::put('/contents',[ContentController::class,'edit']);//修改回覆
    Route::delete('/contents',[ContentController::class,'delete']);//刪除回覆
    //留言
    Route::post('/responds',[RespondController::class,'create']);//新增留言
    Route::put('/responds',[RespondController::class,'edit']);//修改留言
    Route::delete('/responds',[RespondController::class,'delete']);//刪除留言






    //教材文檔
    Route::post('/documents',[DocumentController::class,'create']);
    Route::get('/documents',[DocumentController::class,'get_all']);
});
//不用登入就可以做的事情

Route::get('/guestbooks',[GuestbookController::class,'get_all']);
Route::get('/guestbooks/{id}',[GuestbookController::class,'get_id']);
Route::get('/contents',[ContentController::class,'get_all']);
Route::get('/responds',[RespondController::class,'get_all']);
Route::get('/documents/{id}',[DocumentController::class,'get_id']);