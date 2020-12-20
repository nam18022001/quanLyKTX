<?php

use Illuminate\Support\Facades\Route;
// Controller
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\QuanlyController;
use App\Http\Controllers\AjaxController;
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
//     echo \Carbon\Carbon::now()->day;
//     echo \Carbon\Carbon::now()->month;
//     echo \Carbon\Carbon::now()->year;
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

        Route::group(['prefix' => 'sinh-vien'], function () {
            Route::get('/', [QuanLyController::class, 'tongsinhvien']);
            Route::get('nguoi-thue', [QuanLyController::class, 'tongnguoithue']);
            Route::get('them', [QuanLyController::class, 'themsinhvien']);
            Route::post('them', [QuanLyController::class, 'postthemsinhvien']);
            Route::get('xoa/{id}', [QuanLyController::class, 'xoasinhvien']);
            Route::get('nguoi-thue/xoa/{id}', [QuanLyController::class, 'xoanguoithue']);

            
        });

        Route::group(['prefix' => 'khu-nam'], function () {
            Route::get('quan-ly-phong-nam', [QuanLyController::class, 'quanlyphongnam']);
            Route::get('tang/{id}', [QuanLyController::class, 'phongnam']);
            Route::get('phong/{id}',[QuanLyController::class, 'sinhviennam']);
        });

        Route::group(['prefix' => 'khu-nu'], function () {
            Route::get('quan-ly-phong-nu', [QuanLyController::class, 'quanlyphongnu']);
            Route::get('tang/{id}', [QuanLyController::class, 'phongnu']);
            Route::get('phong/{id}',[QuanLyController::class, 'sinhviennu']);
        });
        Route::group(['prefix' => 'load'], function () {
            Route::get('khu/{id_khu}', [AjaxController::class, 'khu']);
            Route::get('tang/{id_tang}', [AjaxController::class, 'tang']);
            Route::get('phong/{id_phong}', [AjaxController::class, 'phong']);
        });

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

