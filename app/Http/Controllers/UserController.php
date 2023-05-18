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
    public function editProfile(): Factory|View|Application
    {
        return view('user.ubah_profil')->with('title', 'Ubah Profil');
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
        return view('user.ubah_password')->with('title', 'Ubah Password');
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

    public function destroy($id)
    {
        //
    }
}
