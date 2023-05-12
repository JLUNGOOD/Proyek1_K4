<?php

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

Route::get('/pengaduan', function () {
    return view('user.pengaduan');
});

Route::get('/tanggapan', function () {
    return view('user.tanggapan');
});

Route::get('/admin', function () {

    if (Auth::user()->role == '1') {
        return view('admin.index');;
    }

    return redirect('/home');
});

Route::get('/admin/tanggapi', function () {

    if (Auth::user()->role == '1') {
        return view('admin.tanggapi_laporan');
    }

    return redirect('/home');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/login', function () {
//    return view('login');
//});
