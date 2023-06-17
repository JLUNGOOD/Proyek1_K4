<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use App\Models\PengaduanModel;
use App\Models\TanggapanModel;
use App\Services\FileService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

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
        return view('user.buat_pengaduan')->with('categories', $categories)->with('title', 'Buat Pengaduan');
    }

    protected function validator(array $data): \Illuminate\Validation\Validator
    {
        return Validator::make($data, [
            'kategori' => ['required', 'exists:kategori,id'],
            'judul' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
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
        $pengaduan->alamat = $request->alamat;
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
        $pengaduans = PengaduanModel::join('tanggapan', 'pengaduan.id', '=', 'tanggapan.pengaduan_id')
            ->select('pengaduan.*', 'tanggapan.is_read as tanggapan_is_read')
            ->where('pengaduan.user_id', auth()->id())
            ->get();
        return response()->json(['pengaduans' => $pengaduans]);
    }

    function getBelumDitanggapi(Request $request)
    {
        $pengaduans = PengaduanModel::leftJoin('tanggapan', 'pengaduan.id', '=', 'tanggapan.pengaduan_id')
            ->whereNull('tanggapan.pengaduan_id')
            ->select('pengaduan.id', 'pengaduan.judul', 'pengaduan.isi', 'pengaduan.tanggal_kejadian', 'pengaduan.user_id', 'pengaduan.is_read', 'pengaduan.status')
            ->where('pengaduan.user_id', auth()->id())
            ->get();
        return response()->json(['pengaduans' => $pengaduans]);
    }

    function searchPengaduan(Request $request)
    {
        $keyword = $request->keyword;
        $userId = auth()->id();

        if ($request['sortByResponded'] == 0) {
            // Perform left join
            $leftJoin = PengaduanModel::leftJoin('tanggapan', 'pengaduan.id', '=', 'tanggapan.pengaduan_id')
                ->select('pengaduan.*', 'tanggapan.is_read as tanggapan_is_read')
                ->where('pengaduan.user_id', $userId);

            // Perform right join
            $rightJoin = PengaduanModel::rightJoin('tanggapan', 'pengaduan.id', '=', 'tanggapan.pengaduan_id')
                ->select('pengaduan.*', 'tanggapan.is_read as tanggapan_is_read')
                ->whereNull('pengaduan.id')
                ->where('pengaduan.user_id', $userId);

            // Perform union of left join and right join
            $pengaduans = $leftJoin->union($rightJoin)
                ->where('pengaduan.judul', 'like', '%' . $keyword . '%')
                ->get();
        } elseif ($request['sortByResponded'] == 1) {
            $pengaduans = PengaduanModel::join('tanggapan', 'pengaduan.id', '=', 'tanggapan.pengaduan_id')
                ->where('pengaduan.judul', 'like', '%' . $keyword . '%')
                ->where('pengaduan.user_id', $userId)
                ->select('pengaduan.*', 'tanggapan.is_read as tanggapan_is_read')
                ->get();
        } elseif ($request['sortByResponded'] == 2) {
            $pengaduans = PengaduanModel::whereDoesntHave('tanggapan', function ($query) use ($keyword) {
                $query->where('judul', 'like', '%' . $keyword . '%');
            })
                ->where(function ($query) use ($keyword) {
                    $query->where('judul', 'like', '%' . $keyword . '%');
                })
                ->where('user_id', $userId)
                ->select('pengaduan.*')
                ->get();
        }

        return response()->json(['pengaduans' => $pengaduans]);
    }


    public function pengaduanSaya()
    {
        $user = Auth::user();
        $daftar_pengaduan = PengaduanModel::leftJoin('tanggapan', 'pengaduan.id', '=', 'tanggapan.pengaduan_id')
            ->where('pengaduan.user_id', $user->id)
            ->select('pengaduan.*', 'tanggapan.is_read as tanggapan_is_read')
            ->get();

        return view('user.pengaduan_saya')
            ->with('daftar_pengaduan', $daftar_pengaduan)
            ->with('title', 'Pengaduan Saya');
    }


    public function showSemuaPengaduan()
    {
        return view('user.semua_pengaduan')
            ->with('title', 'Semua Pengaduan');
    }

    public function getDataSemuaPengaduan()
    {
        $pengaduans = PengaduanModel::leftJoin('tanggapan', 'pengaduan.id', '=', 'tanggapan.pengaduan_id')
            ->select('pengaduan.*', 'tanggapan.is_read as tanggapan_is_read')
            ->get();
        return DataTables::of($pengaduans)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {
                $status = $row->status;
                $html = $status == "1" ? "<span class='badge bg-success'>Solved</span>" :
                    ($status == "0" ? "<span class='badge bg-danger'>Unsolved</span>" :
                        ($status == "2" ? "<span class='badge bg-warning'>On Progress</span>" :
                            ($status == "3" ? "<span class='badge bg-secondary'>Rejected</span>" : "")));
                return $html;
            })
            ->rawColumns(['status'])
            ->make(true);
    }

    public function detailPengaduan($id)
    {
        $pengaduan = PengaduanModel::find($id);
        $tanggapan = $pengaduan->tanggapan()->get();
        if ($tanggapan->count() > 0) {
            $tanggapan = $tanggapan->first();
            $tanggapan->update([
                'is_read' => '1'
            ]);
        }
        $tanggapan = TanggapanModel::where('pengaduan_id', $id)->first();
        return view('admin.detail_laporan')
            ->with('pengaduan', $pengaduan)
            ->with('tanggapan', $tanggapan)
            ->with('title', 'Detail Pengaduan');
    }

    public function updateStatus()
    {
        $id = request()->id;
        $status = request()->status;
        $pengaduan = PengaduanModel::find($id);
        $pengaduan->status = $status;
        $pengaduan->save();
        return back();
    }

    public function getSolved(Request $request)
    {
        $pengaduans = PengaduanModel::leftJoin('tanggapan', 'pengaduan.id', '=', 'tanggapan.pengaduan_id')
            ->where('pengaduan.status', '=', '1')
            ->select('pengaduan.*', 'tanggapan.is_read as tanggapan_is_read')
            ->where('pengaduan.user_id', auth()->id())
            ->get();
        return response()->json(['pengaduans' => $pengaduans]);
    }

    public function getUnsolved(Request $request)
    {
        $pengaduans = PengaduanModel::leftJoin('tanggapan', 'pengaduan.id', '=', 'tanggapan.pengaduan_id')
            ->where('pengaduan.status', '=', '0')
            ->select('pengaduan.*', 'tanggapan.is_read as tanggapan_is_read')
            ->where('pengaduan.user_id', auth()->id())
            ->get();
        return response()->json(['pengaduans' => $pengaduans]);
    }

    public function getOnProgress(Request $request)
    {
        $pengaduans = PengaduanModel::leftJoin('tanggapan', 'pengaduan.id', '=', 'tanggapan.pengaduan_id')
            ->where('pengaduan.status', '=', '2')
            ->select('pengaduan.*', 'tanggapan.is_read as tanggapan_is_read')
            ->where('pengaduan.user_id', auth()->id())
            ->get();
        return response()->json(['pengaduans' => $pengaduans]);
    }

    public function getRejected(Request $request)
    {
        $pengaduans = PengaduanModel::leftJoin('tanggapan', 'pengaduan.id', '=', 'tanggapan.pengaduan_id')
            ->where('pengaduan.status', '=', '3')
            ->select('pengaduan.*', 'tanggapan.is_read as tanggapan_is_read')
            ->where('pengaduan.user_id', auth()->id())
            ->get();
        return response()->json(['pengaduans' => $pengaduans]);
    }

    public function exportPdf()
    {
        $dateStart = request()->dateStart;
        $dateEnd = request()->dateEnd;
        $pengaduans = PengaduanModel::whereBetween('tanggal_kejadian', [$dateStart, $dateEnd])->get();
        $domPdf = Pdf::loadView('layouts.pengaduan_pdf', ['pengaduans' => $pengaduans, 'dateStart' => $dateStart, 'dateEnd' => $dateEnd]);

        $filename = 'laporan_pengaduan_' . $dateStart . '_to_' . $dateEnd . '.pdf';

        Storage::disk('public')->put('pdf/' . $filename, $domPdf->output());

        return response()->download(public_path('storage/pdf/' . $filename));
    }

}
