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

Route::get('/pengaduan', [PengaduanController::class, 'index']);

Route::get('/tanggapan', function () {
    return view('user.tanggapan');
});

Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/admin/tanggapi', [AdminController::class, 'tanggapi']);
    Route::get('/admin/tambah_admin', [AdminController::class, 'tambah_admin']);
    Route::get('/admin/list_admin', [AdminController::class, 'list_admin']);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/login', function () {
//    return view('login');
//});
