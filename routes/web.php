<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Cookie;

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

Route::get('/', [FormController::class,'index']);

Route::get('/register',[UserController::class, 'getRegister']);
Route::get('/login',[UserController::class, 'getLogin']);