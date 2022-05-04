<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\FormController;

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

Route::post('register', [AuthController::class, 'postRegister']);
Route::post('login', [AuthController::class, 'postLogin']);


Route::middleware('auth:api')->group(function(){

    Route::get('get-user',[AuthController::class, 'userInfo']);

    Route::get('find/{search:query}', [FormController::class, 'find']);

    Route::post('new', [FormController::class, 'store']);

    Route::get('edit/{user:id}', [FormController::class, 'edit']);

    Route::post('edit', [FormController::class, 'update']);

    Route::get('delete/{user:id}', [FormController::class, 'delete']);

    Route::post('logout', [AuthController::class, 'destroy']);

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});