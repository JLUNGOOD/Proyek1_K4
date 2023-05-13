<?php

namespace App\Http\Controllers;

use App\Models\PengaduanModel;
use App\Models\UserModel;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function index() {
        return view('admin.index');
    }

    function tanggapi() {
        $daftar_pengaduan = PengaduanModel::all();
        return view('admin.tanggapi_laporan', ['daftar_pengaduan' => $daftar_pengaduan]);
    }

    function tambah_admin() {
        return view('admin.tambah_admin');
    }

    function list_admin() {
        $admins = UserModel::where('role', '!=','3')->get();
        return view('admin.list_admin', ['admins' => $admins]);
    }
}
