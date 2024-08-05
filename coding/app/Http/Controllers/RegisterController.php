<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index', [
            'title' => 'Register',
            'active' => 'register'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'username' => 'required|max:16|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:16',
            'noHp' => 'required|numeric',
            'nim' => 'required'
        ]);

        // $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        // $request->session()->flash('success', 'Registrasi berhasil, login');
        return redirect('/login')->with('success', 'Registrasi berhasil, silakan login');
    }
}
