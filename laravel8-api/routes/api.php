<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\HomeController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//認証
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

//テスト用
Route::get('/test', [HomeController::class, 'test']);

//メイン処理
Route::get('/edit/{id}', [HomeController::class, 'edit']);
Route::post('/store/{id}', [HomeController::class, 'store']);
Route::post('/delete/{id}', [HomeController::class, 'delete']);
Route::post('/start/{id}', [HomeController::class, 'start']);
Route::post('/stop/{id}', [HomeController::class, 'stop']);
Route::post('/labels/{id}', [HomeController::class, 'labels']);

//ログインしたユーザーのみが/hogeにアクセスできる
Route::middleware('auth:sanctum')->group(function(){
    Route::get('/hoge', function(){
        return 'auth is working';
    });
});