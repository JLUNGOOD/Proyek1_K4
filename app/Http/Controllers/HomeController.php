<?php

namespace App\Http\Controllers;

use App\Models\KegiatanModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function index()
    {
        if (Auth::user()->role == '1') {
            return redirect('admin');
        }

        $kegiatans = KegiatanModel::latest()->get();
        return view('user.home_user')
            ->with('kegiatans', $kegiatans)->with('title', 'Halaman Utama PDAM');
    }

    public function showKegiatan($slug)
    {
        $kegiatan = KegiatanModel::where('slug', $slug)->first();
        return view('user.show_kegiatan')
            ->with('kegiatan', $kegiatan)->with('title', $kegiatan->judul_kegiatan);
    }
}
