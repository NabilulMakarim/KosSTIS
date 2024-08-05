<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            // 'email' => 'required|email', 
            //jika mau domain nya ketat, misal harus resmi, bisa jadikan email:dns
            'username' => 'required',
            'password' => 'required'
        ]);

        $pengguna = User::where('username', $credentials['username'])->first();


        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            if ($pengguna->is_admin == 0) {
                return redirect('/');
            } else {
                return redirect('/dashboard');
            }
            // return redirect()->intended('/dashboard');

        }

        return back()->with('loginError', 'Login gagal, Username atau Password salah');
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }
}
