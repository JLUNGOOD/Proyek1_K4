<?php

namespace App\Http\Controllers;

use App\Models\KegiatanModel;
use App\Models\TanggapanModel;
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
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function index()
    {
        $kegiatans = KegiatanModel::latest()->limit(7)->get();
        $new_tanggapans = [];
        if (Auth::check()) {
            $pengaduans = auth()->user()->pengaduan()->get();
            foreach ($pengaduans as $i => $pengaduan) {
                $tanggapan = $pengaduan->tanggapan()->latest()->first();
                if ($tanggapan) {
                    if ($tanggapan->is_read == 0) {
                        $new_tanggapans[$i] = $tanggapan;
                    }
                }
            }
            session(['new_tanggapans' => $new_tanggapans]);
        }
        return view('user.home_user')
            ->with('kegiatans', $kegiatans)
            ->with('title', 'Halaman Utama PDAM');
    }

    public function showKegiatan($slug)
    {
        $kegiatan = KegiatanModel::where('slug', $slug)->first();
        return view('user.show_kegiatan')
            ->with('kegiatan', $kegiatan)->with('title', $kegiatan->judul_kegiatan);
    }
}
