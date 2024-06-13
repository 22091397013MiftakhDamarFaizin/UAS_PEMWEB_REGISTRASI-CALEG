<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman login.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('login-parpol');
    }

    /**
     * Proses login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $user = User::where('username', $request->username)->first();
    
        if ($user && $user->password == $request->password) {
            // Jika autentikasi berhasil, set user ke dalam session
            auth()->login($user);
            // Redirect ke halaman beranda
            return redirect()->route('beranda-parpol')->with(['status' => 'success', 'message' => 'Login berhasil!']);
        } else {
            // Jika autentikasi gagal, kembalikan ke halaman login dengan pesan error
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Username atau password salah.']);
        }
    }

    /**
     * Logout pengguna.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login')->with(['status' => 'success', 'message' => 'Logout berhasil!']);
    }
}
