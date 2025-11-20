<?php

namespace App\Http\Controllers;

use App\Models\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // TAMPILKAN HALAMAN LOGIN
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = Auth::where('username', $request->username)->first();

        if (!$user) {
            return back()->withErrors(['login' => 'Username tidak ditemukan'])->withInput();
        }

        if ($user->password !== $request->password) {
            return back()->withErrors(['login' => 'Password salah'])->withInput();
        }

        Session::put('user', [
            'id'       => $user->id,
            'nama'     => $user->nama,
            'username' => $user->username,
            'role'     => $user->role,
        ]);

        return redirect()->route('index');
    }

    public function logout()
    {
        Session::forget('user');
        return redirect()->route('login');
    }
}
