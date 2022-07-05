<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\FormTesDriveController;

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
Route::post('login',[UserController::class,'login']);
Route::resource('user', UserController::class);
Route::resource('department', DepartmentController::class);
Route::resource('aset', AsetController::class);
Route::resource('formtesdrive', FormTesDriveController::class);
Route::get('totaltesdrive',[FormTesDriveController::class,'count']);
Route::get('totalaset',[AsetController::class,'count']);
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
