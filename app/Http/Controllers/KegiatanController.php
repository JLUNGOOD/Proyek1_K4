<?php

namespace App\Http\Controllers;

use App\Models\KegiatanModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class KegiatanController extends Controller
{
    public function index(): Factory|View|Application
    {
        $kegiatans = KegiatanModel::latest()->get();
        return view('user.kegiatan')
            ->with('kegiatans', $kegiatans)
            ->with('title', 'Kegiatan');
    }
}
