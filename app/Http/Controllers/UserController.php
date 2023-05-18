<?php

namespace App\Http\Controllers;

use App\Models\DokterModel;
use App\Models\UserModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function update()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    public function editProfile(): Factory|View|Application
    {
        if(auth()->check()){
            if(auth()->user()->role == 1){
                return view('admin.ubah_profil');
            }else if(auth()->user()->role == 2){
                return view('pegawai.ubah_profil');
            }else if(auth()->user()->role == 3){
                return view('user.ubah_profil');
            }
        }
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required']
        ]);

        UserModel::where('id', '=', auth()->user()->id)->update($request->except(['_token', '_method']));

        return back()
            ->with('success', 'Profil Anda Berhasil Diubah');
    }

    public function editPassword(): Factory|View|Application
    {
        if(auth()->check()){
            if(auth()->user()->role == 1){
                return view('admin.ubah_password');
            }else if(auth()->user()->role == 2){
                return view('pegawai.ubah_password');
            }else if(auth()->user()->role == 3){
                return view('user.ubah_password');
            }
        }
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'old_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);

        $request['password'] = Hash::make($request['password']);

        UserModel::where('id', '=', auth()->user()->id)->update($request->except(['_token', '_method', 'old_password', 'password_confirmation']));

        return back()->with('success', 'Password Anda Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
