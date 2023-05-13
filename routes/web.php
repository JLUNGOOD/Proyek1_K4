<?php

use App\Http\Controllers\PengaduanController;
use App\Models\UserModel;
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
    Route::get('/admin', function () {
        return view('admin.index');
    });

    Route::get('/admin/tanggapi', function () {
        return view('admin.tanggapi_laporan');
    });

    Route::get('/admin/tambah_admin', function () {
        return view('admin.tambah_admin');
    });

    Route::get('/admin/list_admin', function () {
        $admins = UserModel::where('role', '!=','3')->get();
        return view('admin.list_admin', ['admins' => $admins]);
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/login', function () {
//    return view('login');
//});
