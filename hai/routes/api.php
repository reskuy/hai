<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\FormTesDriveController;
use App\Http\Controllers\FormPeminjamanController;
use App\Http\Controllers\FormPengembalianPeminjamanController;
use App\Http\Controllers\FormPengembalianTesDriveController;

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
Route::resource('formpeminjaman', FormPeminjamanController::class);
Route::resource('pengembalianpeminjaman', FormPengembalianPeminjamanController::class);
Route::resource('pengembaliantesdrive', FormPengembalianTesDriveController::class);
Route::get('totaltesdrive',[FormTesDriveController::class,'count']);
Route::get('totalaset',[AsetController::class,'count']);
Route::get('totaluser',[UserController::class,'count']);
Route::get('totalpeminjaman',[FormPeminjamanController::class,'count']);
Route::get('totalpengembaliantesdrive',[FormPengembalianTesDriveController::class,'count']);
Route::get('totalpengembalianpeminjaman',[FormPengembalianPeminjamanController::class,'count']);
Route::get('historypeminjaman/{id}',[FormPeminjamanController::class,'history']);
Route::put('approveformtesdrive/{id}',[FormTesDriveController::class,'approve']);
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
