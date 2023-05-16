<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PengaduanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Auth::routes();

Route::get('/', function () {
    return view('user.home_user');
});

Route::middleware('auth')->group(function () {
    Route::get('/buat_pengaduan', [PengaduanController::class, 'create']);
    Route::post('/buat_pengaduan', [PengaduanController::class, 'store' ])->name('pengaduan.store');

    Route::get('/pengaduan_saya', function () {
        return view('user.pengaduan_saya');
    });
});

Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/admin/tanggapi', [AdminController::class, 'tanggapi']);
    Route::get('/admin/tambah_admin', [AdminController::class, 'tambah_admin']);
    Route::get('/admin/list_admin', [AdminController::class, 'list_admin']);
    Route::post('/admin/create_user', [AdminController::class, 'create_user']);
    Route::post('/admin/delete_user/{id}', [AdminController::class, 'delete_user']);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/login', function () {
//    return view('login');
//});
