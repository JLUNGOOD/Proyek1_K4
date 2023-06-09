<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use App\Models\KegiatanModel;
use App\Models\PengaduanModel;
use App\Models\TanggapanModel;
use App\Models\UserModel;
use App\Services\FileService;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    protected $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    function index()
    {
        $user = auth()->user();
        $today = Carbon::today();
        $month = Carbon::now()->month;
        $categories = KategoriModel::all();
        $categories_name = [];
        $pengaduan_count = [];
        $total_user = UserModel::count();
        $user_today = UserModel::whereDate('created_at', $today)->count();
        $pengaduans = [
            'total' => PengaduanModel::all()->count(),
            'total_sudah_direspon' => PengaduanModel::whereHas('tanggapan')->count(),
            'total_belum_direspon' => PengaduanModel::whereDoesntHave('tanggapan')->count(),
            'today_sudah_direspon' => PengaduanModel::whereHas('tanggapan')
                ->whereDate('created_at', $today)
                ->count(),
            'today_belum_direspon' => PengaduanModel::whereDoesntHave('tanggapan')
                ->whereDate('created_at', $today)
                ->count(),
            'bulan_ini_belum_direspon' => PengaduanModel::whereDoesntHave('tanggapan')
                ->whereMonth('created_at', $month)
                ->count(),
            'bulan_ini_sudah_direspon' => PengaduanModel::whereHas('tanggapan')
                ->whereMonth('created_at', $month)
                ->count()
        ];

        // for displaying in chart dropdown
        $months = [];
        for ($month = 1; $month <= 12; $month++) {
            $date = Carbon::create(null, $month, 1);
            $months[] = $date->locale('your_locale')->monthName;
        }

        $selected_month = request('month') ?? Carbon::now()->month;
        if ($selected_month == 13) {
            foreach ($categories as $i => $category) {
                $categories_name[$i] = $category->name;
                $pengaduan_count[$i] = PengaduanModel::where('kategori_id', $category->id)->count();
            }
        } else {
            foreach ($categories as $i => $category) {
                $categories_name[$i] = $category->name;
                $pengaduan_count[$i] = PengaduanModel::where('kategori_id', $category->id)->whereMonth('created_at', $selected_month)->count();
            }
        }
        return view('admin.index')
            ->with('user', $user)
            ->with('categories_name', json_encode($categories_name))
            ->with('pengaduan_count', json_encode($pengaduan_count))
            ->with('pengaduans', $pengaduans)
            ->with('months', $months)
            ->with('selected_month', $selected_month)
            ->with('title', 'Dashboard Admin')
            ->with('total_user', $total_user)
            ->with('user_today', $user_today);
    }

    function list_tanggapi()
    {
//        $daftar_pengaduan = PengaduanModel::all();
//        return view('admin.tanggapi_laporan')
//            ->with('daftar_pengaduan', $daftar_pengaduan)
//            ->with('title', 'Tanggapi Laporan');
        return view('admin.semua_pengaduan')
            ->with('title', 'Tanggapi Pengaduan');
    }

    function tambah_admin()
    {
        return view('admin.tambah_admin')->with('title', 'Tambah Pengguna');
    }

    function list_admin()
    {
        $admins = UserModel::where('role', '!=', '3')->get();
        return view('admin.list_admin')
            ->with('admins', $admins)
            ->with('title', 'Daftar Admin & Pegawai');
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
            'password' => Hash::make($request['password']),
        ]);
        return redirect('/admin/list_admin')->with('message', 'User berhasil ditambahkan');
    }

    function delete_user($id)
    {
        // dd($id);
        UserModel::destroy($id);
        return redirect('/admin/list_admin')->with('message', 'User berhasil dihapus');
    }

    function delete_user_api()
    {
        UserModel::destroy(request('id'));
        session()->flash('message', 'User berhasil dihapus');
        return response()->json([
            'message' => 'User berhasil dihapus',
            'status' => 'success'
        ]);
    }

    function tanggapi($id)
    {
        $pengaduan = PengaduanModel::find($id);
        $pengaduan->update(['is_read' => '1']);

        $tanggapan = TanggapanModel::where('pengaduan_id', $id)->first();
        return view('admin.detail_laporan')
            ->with('pengaduan', $pengaduan)
            ->with('tanggapan', $tanggapan)
            ->with('title', 'Detail Pengaduan');
    }

//    send tanggapan
    function send_tanggapan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'foto_tanggapan' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:5120'],
            'isi_tanggapan' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect('/admin/tanggapi/' . $request['pengaduan_id'])
                ->withErrors($validator)
                ->withInput();
        }
        $tanggapan = new TanggapanModel;
        $tanggapan->user_id = auth()->user()->id;
        $tanggapan->pengaduan_id = $request['pengaduan_id'];
        if ($request->hasFile('foto_tanggapan')) {
            $image = $request->file('foto_tanggapan');
            $uniqueFileName = $this->fileService->generateUniqueFileName($image, $tanggapan->pengaduan_id);
            $image->storeAs('public/foto_tanggapan', $uniqueFileName);

            $tanggapan->foto_tanggapan = $uniqueFileName;
        }
        $tanggapan->isi_tanggapan = $request['isi_tanggapan'];

        $tanggapan->save();

        PengaduanModel::where('id', $request['pengaduan_id'])->update(['status' => $request['status']]);
        return redirect('/admin/tanggapi/' . $request['pengaduan_id'])->with('message', 'Tanggapan berhasil dikirim');
    }

    public function edit_user($id)
    {
        $user = UserModel::find($id);
        return view('admin.tambah_admin')->with('user', $user)->with('title', 'Ubah Pengguna');
    }

    public function update_user(Request $request, $id)
    {
        $user = UserModel::find($id);
        $user->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'role' => $request['role'],
            'jenis_kelamin' => $request['jenis_kelamin'],
            'tanggal_lahir' => $request['tanggal_lahir'],
        ]);
        return redirect('/admin/list_admin')->with('message', 'User berhasil diupdate');
    }

    public function list_kegiatan()
    {
        $kegiatans = KegiatanModel::latest()->get();

        return view('admin.list_kegiatan')->with('kegiatans', $kegiatans)->with('title', 'Daftar Kegiatan');
    }

    public function createKegiatan()
    {
        return view('admin.tambah_kegiatan')->with('title', 'Tambah Kegiatan');
    }

    protected function validator(array $data): \Illuminate\Validation\Validator
    {
        return Validator::make($data, [
            'judul_kegiatan' => ['required', 'string', 'max:255'],
            'foto_kegiatan' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:5120'],
            'isi_kegiatan' => ['required', 'string'],
            'tanggal_kegiatan' => ['required', 'date'],
        ]);
    }

    protected function storeKegiatan(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $kegiatan = new KegiatanModel;
        $kegiatan->user_id = auth()->user()->id;
        $kegiatan->judul_kegiatan = $request->judul_kegiatan;
        $kegiatan->slug = Str::slug($kegiatan->judul_kegiatan, '-');

        if ($request->hasFile('foto_kegiatan')) {
            $image = $request->file('foto_kegiatan');
            $uniqueFileName = $this->fileService->generateUniqueFileName($image, $kegiatan->judul_kegiatan);
            $image->storeAs('public/foto_kegiatan', $uniqueFileName);

            $kegiatan->foto_kegiatan = $uniqueFileName;
        }

        $kegiatan->isi_kegiatan = $request->isi_kegiatan;
        $kegiatan->tanggal_kegiatan = $request->tanggal_kegiatan;

        $kegiatan->save();

        return back()->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function editKegiatan($slug): Factory|View|Application
    {
        $kegiatan = KegiatanModel::where('slug', $slug)->first();
        return view('admin.edit_kegiatan')
            ->with('kegiatan', $kegiatan)
            ->with('title', 'Ubah Kegiatan');
    }

    protected function updateKegiatan(Request $request, $slug)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $kegiatan = KegiatanModel::where('slug', $slug)->first();
        $kegiatan->judul_kegiatan = $request->judul_kegiatan;
        $kegiatan->slug = Str::slug($kegiatan->judul_kegiatan, '-');

        if ($request->has('hapus_gambar')) {
            if ($kegiatan->foto_kegiatan) {
                Storage::delete('public/foto_kegiatan/' . $kegiatan->foto_kegiatan);
            }

            $kegiatan->foto_kegiatan = null;
        } else if ($request->hasFile('foto_kegiatan')) {
            if ($kegiatan->foto_kegiatan) {
                Storage::delete('public/foto_kegiatan/' . $kegiatan->foto_kegiatan);
            }

            $image = $request->file('foto_kegiatan');
            $uniqueFileName = $this->fileService->generateUniqueFileName($image, $kegiatan->judul_kegiatan);
            $image->storeAs('public/foto_kegiatan', $uniqueFileName);

            $kegiatan->foto_kegiatan = $uniqueFileName;
        }

        $kegiatan->isi_kegiatan = $request->isi_kegiatan;
        $kegiatan->tanggal_kegiatan = $request->tanggal_kegiatan;
        $kegiatan->save();

        if ($kegiatan->wasChanged('slug')) {
            return redirect()->route('admin.edit-kegiatan', ['slug' => $kegiatan->slug])->with('success', 'Kegiatan berhasil diperbarui.');
        } else {
            return back()->with('success', 'Kegiatan berhasil diperbarui.');
        }
    }

    public function destroyKegiatan($slug)
    {
        $kegiatan = KegiatanModel::where('slug', $slug)->first();

        if ($kegiatan->foto_kegiatan) {
            Storage::delete('public/foto_kegiatan/' . $kegiatan->foto_kegiatan);
        }

        $kegiatan->delete();

        return back()->with('success', 'Kegiatan berhasil dihapus.');
    }

}
