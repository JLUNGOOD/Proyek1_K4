<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth')->group(function () {
    Route::get('/buat_pengaduan', [PengaduanController::class, 'create']);
    Route::post('/buat_pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');

    Route::get('/pengaduan_saya', [PengaduanController::class, 'pengaduanSaya']);

    Route::get('/ubah_profil', [UserController::class, 'editProfile'])->name('user.edit-profile');
    Route::post('/ubah_profil', [UserController::class, 'updateProfile'])->name('user.update-profile');

    Route::get('/ubah_password', [UserController::class, 'editPassword'])->name('user.edit-password');
    Route::post('/ubah_password', [UserController::class, 'updatePassword'])->name('user.update-password');
    Route::get('/admin/tanggapi/{id}', [AdminController::class, 'tanggapi']);

    Route::middleware(['admin'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index']);
        Route::get('/admin/tanggapi', [AdminController::class, 'list_tanggapi']);
        Route::get('/admin/tambah_admin', [AdminController::class, 'tambah_admin']);
        Route::get('/admin/list_admin', [AdminController::class, 'list_admin']);
        Route::post('/admin/create_user', [AdminController::class, 'create_user']);
        Route::post('/admin/delete_user/{id}', [AdminController::class, 'delete_user']);
        Route::post('/admin/delete_user_api', [AdminController::class, 'delete_user_api']);

        Route::post('/admin/send_tanggapan', [AdminController::class, 'send_tanggapan']);
        Route::get('/admin/{id}/edit_user', [AdminController::class, 'edit_user']);

        Route::post('/admin/tanggapan/update_status', [PengaduanController::class, 'updateStatus']);

        Route::get('/admin/kegiatan', [AdminController::class, 'list_kegiatan'])->name('admin.list-kegiatan');
        Route::get('/admin/tambah_kegiatan', [AdminController::class, 'createKegiatan'])
            ->name('admin.create-kegiatan');
        Route::post('/admin/tambah_kegiatan', [AdminController::class, 'storeKegiatan'])
            ->name('admin.store-kegiatan');
        Route::get('/admin/kegiatan/{slug}/edit', [AdminController::class, 'editKegiatan'])
            ->name('admin.edit-kegiatan');
        Route::post('/admin/kegiatan/{slug}/edit', [AdminController::class, 'updateKegiatan'])
            ->name('admin.update-kegiatan');
        Route::delete('/admin/kegiatan/{slug}', [AdminController::class, 'destroyKegiatan'])
            ->name('admin.delete-kegiatan');

    });
});

Route::get('/', [HomeController::class, 'index']);
Route::get('/kegiatan/', [KegiatanController::class, 'index'])->name('kegiatan.kegiatan');
Route::get('/kegiatan/{slug}', [HomeController::class, 'showKegiatan'])->name('user.show-kegiatan');

Route::post('/pengaduan/sudah_ditanggapi', [PengaduanController::class, 'getSudahDitanggapi']);
Route::post('/pengaduan/belum_ditanggapi', [PengaduanController::class, 'getBelumDitanggapi']);
Route::post('/pengaduan/solved', [PengaduanController::class, 'getSolved']);
Route::post('/pengaduan/unsolved', [PengaduanController::class, 'getUnsolved']);
Route::post('/pengaduan/on_progress', [PengaduanController::class, 'getOnProgress']);
Route::post('/pengaduan/rejected', [PengaduanController::class, 'getRejected']);
Route::post('/pengaduan/search', [PengaduanController::class, 'searchPengaduan']);

//Route::get('/login', function () {
//    return view('login');
//});
