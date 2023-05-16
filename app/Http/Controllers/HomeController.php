<?php

namespace App\Http\Controllers;

use App\Models\kegiatanModel;
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

        $kegiatan = kegiatanModel::all();
        return view('user.home_user')
            ->with('kegiatan', $kegiatan);

    }
}
