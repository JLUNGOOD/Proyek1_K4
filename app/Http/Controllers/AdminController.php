<?php

namespace App\Http\Controllers;

use App\Models\PengaduanModel;
use App\Models\TanggapanModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    function index()
    {
        return view('admin.index');
    }

    function list_tanggapi()
    {
        $daftar_pengaduan = PengaduanModel::all();
        return view('admin.tanggapi_laporan', ['daftar_pengaduan' => $daftar_pengaduan]);
    }

    function tambah_admin()
    {
        return view('admin.tambah_admin');
    }

    function list_admin()
    {
        $admins = UserModel::where('role', '!=', '3')->get();
        return view('admin.list_admin', ['admins' => $admins]);
    }

    function create_user(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
            'tanggal_lahir' => ['required'],
            'role' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect('/admin/tambah_admin')
                ->withErrors($validator)
                ->withInput();
        }

        UserModel::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'role' => $request['role'],
            'jenis_kelamin' => $request['jenis_kelamin'],
            'tanggal_lahir' => $request['tanggal_lahir'],
            'password' => Hash::make($request['password_register']),
        ]);
        return redirect('/admin/list_admin')->with('message', 'User berhasil ditambahkan');
    }

    function delete_user($id)
    {
        UserModel::destroy($id);
        return redirect('/admin/list_admin')->with('message', 'User berhasil dihapus');
    }

    function tanggapi($id)
    {
        $pengaduan = PengaduanModel::find($id);
        $tanggapan = TanggapanModel::where('pengaduan_id', $id)->first();
        return view('admin.detail_laporan', ['pengaduan' => $pengaduan, 'tanggapan' => $tanggapan]);
    }
}
