<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use App\Models\PengaduanModel;
use App\Services\FileService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengaduanController extends Controller
{
    protected $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

//    public function index()
//    {
//        $categories = KategoriModel::all();
//        return view('user.buat_pengaduan')->with('categories', $categories);
//    }

    protected function create(): Factory|View|Application
    {
        $categories = KategoriModel::all();
        return view('user.buat_pengaduan')->with('categories', $categories);
    }

    protected function validator(array $data): \Illuminate\Validation\Validator
    {
        return Validator::make($data, [
            'kategori' => ['required', 'exists:kategori,id'],
            'judul' => ['required', 'string', 'max:255'],
            'isi' => ['required', 'string'],
            'tanggal_kejadian' => ['nullable', 'date'],
            'bukti_gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
        ]);
    }

    protected function store(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $pengaduan = new PengaduanModel;
        $pengaduan->kategori_id = $request->kategori;
        $pengaduan->user_id = auth()->id();
        $pengaduan->judul = $request->judul;
        $pengaduan->isi = $request->isi;
        $pengaduan->tanggal_kejadian = $request->tanggal_kejadian;

        if ($request->hasFile('bukti_gambar')) {
            $image = $request->file('bukti_gambar');
            $uniqueFileName = $this->fileService->generateUniqueFileName($image, $request->judul);
            $image->storeAs('public/bukti_gambar_pengaduan', $uniqueFileName);

            $pengaduan->bukti_gambar = $uniqueFileName;
        }

        $pengaduan->is_read = 0;
        $pengaduan->save();

        return back()->with('success', 'Pengaduan Anda berhasil dikirim. Terima kasih atas kontribusinya!');
    }

    function getSudahDitanggapi(Request $request)
    {
        $pengaduans = PengaduanModel::whereHas('tanggapan')->get();
        return response()->json(['pengaduans' => $pengaduans]);
    }
    function getBelumDitanggapi(Request $request)
    {
        $pengaduans = PengaduanModel::leftJoin('tanggapan', 'pengaduan.id', '=', 'tanggapan.pengaduan_id')
            ->whereNull('tanggapan.pengaduan_id')
            ->select('pengaduan.id', 'pengaduan.judul', 'pengaduan.isi', 'pengaduan.tanggal_kejadian')
            ->get();
        return response()->json(['pengaduans' => $pengaduans]);
    }
}
