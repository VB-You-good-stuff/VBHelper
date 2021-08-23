<?php

use App\Http\Controllers\MembersController;
use App\Http\Controllers\GuestbookController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\RespondController;
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
    Route::post('/members',[MembersController::class,'register']);
    Route::get('/members',[MembersController::class,'getaccount']);
    Route::post('/login',[MembersController::class,'login']);
    Route::post('/logout',[MembersController::class,'logout']);
    Route::post('/guestbooks',[GuestbookController::class,'create']);
    Route::get('/guestbooks',[GuestbookController::class,'get_all']);
    Route::delete('/guestbooks',[GuestbookController::class,'delete']);
    Route::post('/contents',[ContentController::class,'create']);
    Route::post('/responds',[RespondController::class,'create']);
    Route::put('/responds',[RespondController::class,'edit']);
    
    
});

