<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use App\Models\PengaduanModel;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengaduanController extends Controller
{
    protected $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function index()
    {
        $categories = KategoriModel::all();
        return view('user.pengaduan')->with('categories', $categories);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'kategori' => ['required', 'exists:kategori,id'],
            'judul' => ['required', 'string', 'max:255'],
            'isi' => ['required', 'string'],
            'tanggal_kejadain' => ['nullable', 'date'],
            'bukti_gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
        ]);
    }

    protected function create(array $data)
    {
        return PengaduanModel::create([
            'kategori_id' => $data['kategori'],
            'user_id' => auth()->id(),
            'judul' => $data['judul'],
            'isi' => $data['isi'],
            'tanggal_kejadian' => $data['tanggal_kejadian'] ?? null,
            'bukti_gambar' => $data['image'] ?? null,
            'is_read' => 0
        ]);
    }

    protected function store(Request $request)
    {
        $validator = self::validator($request->all());

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('bukti_gambar')) {
            $image = $request->file('bukti_gambar');
            $uniqueFileName = $this->fileService->generateUniqueFileName($image, $request->judul);
            $image->move('img/pengaduan', $uniqueFileName);

            $request->merge([
                'image' => $uniqueFileName,
            ]);
        }

        self::create($request->all());

        return back()->with('success', 'Pengaduan Anda berhasil dikirim. Terima kasih atas kontribusinya!');
    }
}
