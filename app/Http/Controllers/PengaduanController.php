<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;

class PengaduanController extends Controller
{
    public function index()
    {
        $categories = KategoriModel::all();
        return view('user.pengaduan')->with('categories', $categories);
    }
}
