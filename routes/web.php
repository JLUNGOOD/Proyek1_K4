<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\UserController;
use App\Models\kegiatanModel;
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
    $kegiatan = kegiatanModel::all();
    return view('user.home_user')
        ->with('kegiatan', $kegiatan);
});

Route::middleware('auth')->group(function () {
    Route::get('/buat_pengaduan', [PengaduanController::class, 'create']);
    Route::post('/buat_pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');

    Route::get('/pengaduan_saya', [PengaduanController::class, 'pengaduan_saya']);

    Route::get('/ubah_profil', [UserController::class, 'editProfile' ])->name('user.edit-profile');
    Route::post('/ubah_profil', [UserController::class, 'updateProfile' ])->name('user.update-profile');

    Route::get('/ubah_password', [UserController::class, 'editPassword' ])->name('user.edit-password');
    Route::post('/ubah_password', [UserController::class, 'updatePassword' ])->name('user.update-password');
});

Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/admin/tanggapi', [AdminController::class, 'list_tanggapi']);
    Route::get('/admin/tambah_admin', [AdminController::class, 'tambah_admin']);
    Route::get('/admin/list_admin', [AdminController::class, 'list_admin']);
    Route::post('/admin/create_user', [AdminController::class, 'create_user']);
    Route::post('/admin/delete_user/{id}', [AdminController::class, 'delete_user']);
    Route::get('/admin/tanggapi/{id}', [AdminController::class, 'tanggapi']);
    Route::post('/admin/send_tanggapan', [AdminController::class, 'send_tanggapan']);
    Route::get('/admin/{id}/edit_user', [AdminController::class, 'edit_user']);
});

Route::post('/pengaduan/sudah_ditanggapi', [PengaduanController::class, 'getSudahDitanggapi']);
Route::post('/pengaduan/belum_ditanggapi', [PengaduanController::class, 'getBelumDitanggapi']);
Route::post('/pengaduan/search', [PengaduanController::class, 'searchPengaduan']);

Route::get('/home', [HomeController::class, 'index']);

//Route::get('/login', function () {
//    return view('login');
//});
