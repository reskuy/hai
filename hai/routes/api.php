<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\LogController;
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
Route::get('time', [UserController::class,'time']);
Route::resource('department', DepartmentController::class);
Route::resource('aset', AsetController::class);
Route::get('log/{tgl}', [LogController::class,'index']);
Route::post('log', [LogController::class,'store']);
Route::resource('formtesdrive', FormTesDriveController::class);
Route::resource('formpeminjaman', FormPeminjamanController::class);
Route::resource('pengembalianpeminjaman', FormPengembalianPeminjamanController::class);
Route::resource('pengembaliantesdrive', FormPengembalianTesDriveController::class);
Route::get('totaltesdrive/{id}',[FormTesDriveController::class,'count']);
Route::get('totaltesdrivetoday',[FormTesDriveController::class,'todaycount']);
Route::get('totalaset/{id}',[AsetController::class,'count']);
Route::get('seen/{name}/{id}',[UserController::class,'seen']);
Route::get('setseen/{name}',[UserController::class,'setseen']);
Route::get('totaluser',[UserController::class,'count']);
Route::get('totalpeminjaman/{id}',[FormPeminjamanController::class,'count']);
Route::get('totalpeminjamantoday',[FormPeminjamanController::class,'todaycount']);
Route::get('totalpengembaliantesdrive/{id}',[FormPengembalianTesDriveController::class,'count']);
Route::get('totalpengembalianpeminjaman/{id}',[FormPengembalianPeminjamanController::class,'count']);
Route::get('historypeminjaman/{id}/{department}',[FormPeminjamanController::class,'history']);
Route::get('historytesdrive/{id}/{department}',[FormTesDriveController::class,'history']);
Route::get('laporantesdrive/{TglAwal}/{TglAkhir}',[FormTesDriveController::class,'laporan']);
Route::get('laporanpeminjaman/{TglAwal}/{TglAkhir}',[FormPeminjamanController::class,'laporan']);
Route::get('laporanpengembaliantesdrive/{TglAwal}/{TglAkhir}',[FormPengembalianTesDriveController::class,'laporan']);
Route::get('laporanpengembalianpeminjaman/{TglAwal}/{TglAkhir}',[FormPengembalianPeminjamanController::class,'laporan']);
Route::put('approveformtesdrive/{id}',[FormTesDriveController::class,'approve']);
Route::put('approveformpeminjaman/{id}',[FormPeminjamanController::class,'approve']);
Route::put('approvepengembalianformtesdrive/{id}',[FormPengembalianTesDriveController::class,'approve']);
Route::put('approvepengembalianpeminjaman/{id}',[FormPengembalianPeminjamanController::class,'approve']);
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
