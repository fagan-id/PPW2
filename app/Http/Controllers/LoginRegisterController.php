<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginRegisterController extends Controller
{


    /**
     * Inisiasi instansi LoginRegisterController
     */
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout','dashboard'
        ]);
    }

    /**
     * Menampilkan Form Registrasi
     */
    public function register()
    {
        return view('register');
    }


        /**
     * Menampilkan Data Form Registrasi
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $credentials = $request->only('email','password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('dashboard_admin')->withSuccess('You Have Succesfully Registered & Logged In!');
    }

    /**
     * Menampilkan Form Login
     */
    public function login()
    {
        return view('login');
    }



    /**
     * Melakukan Autentikasi Credential Pengguna yang Login
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email'=> 'required|email',
            'password'=> 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard_admin')->withSuccess('You Have Succesfully Logged In!');
        }

        return back()->withErrors([
            'email' => 'Your Provided Credentials do not match in our Records.'
        ])->onlyInput('email');
    }

        /**
     * Menampilkan Layar Dashboard Untuk Pengguna yang telah Terautentikasi
     */
    public function dashboard()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard_admin')->withSuccess('You Have Succesfully Logged In!');
        }
        $data_buku = Buku::paginate(10);
        return view('dashboard',compact('data_buku'));
    }

        /**
     * Melakukan Operasi Logout Oleh Pengguna
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->withSuccess('You Have Succesfully Logged Out!');;
    }
}
