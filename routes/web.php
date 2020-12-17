<?php

use Illuminate\Support\Facades\Route;
// Controller
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\QuanlyController;
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
// Route::get('test', function () {
//     echo bcrypt('123');
// });
Route::get('quan-ly/dang-nhap', [AdminController::class, 'login']);
Route::post('quan-ly/post-dang-nhap', [AdminController::class, 'postlogin']);
Route::get('quan-ly/dang-xuat', [AdminController::class, 'logout']);

// Route của quản lý
Route::group(['middleware' => 'adminlogin'], function () {
    Route::group(['middleware' => 'shutdown'], function () {
        // Bảo vệ
        Route::get('dang-bao-tri', [AdminController::class, 'off']);
        Route::get('shutdown', [AdminController::class, 'shutdown']);
        Route::get('shutup', [AdminController::class, 'shutup']);
    });

    Route::group(['prefix' => 'quan-ly'], function () {
        Route::get('/', [QuanLyController::class, 'index']);
        Route::get('quan-ly-phong-nam', [QuanLyController::class, 'quanlyphongnam']);
        Route::get('quan-ly-phong-nu', [QuanLyController::class, 'quanlyphongnu']);

    });
});
// Route của sinh viên
Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'sinh-vien'], function () {
        
    });
});
// Route của page
Route::group(['middleware' => 'offwebsite'], function () {
    Route::get('/', function () {

    });
});

