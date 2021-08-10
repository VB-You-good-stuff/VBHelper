<?php

use App\Http\Controllers\MembersController;
use App\Http\Controllers\GuestbookController;
use App\Http\Controllers\ArticleController;
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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

//Route::resource('members',MembersController::class);
//Route::resource('guestbook',GuestbookController::class);



//Route::get('/members',[MembersController::class,'index']);
Route::group([
    'middleware' => 'api',
],function($router){
    Route::post('/members',[MembersController::class,'register']);
    Route::post('/login',[MembersController::class,'login']);
    Route::post('/logout',[MembersController::class,'logout']);
    Route::post('/guestbooks',[GuestbookController::class,'create']);
});

