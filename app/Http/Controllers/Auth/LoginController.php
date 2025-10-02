<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/'; // Arahkan ke halaman home setelah login

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Perbaiki ejaan di baris ini
        $this->middleware('guest')->except('logout');
    }

    /**
     * Tampilkan form login.
     */
    public function showLoginForm()
    {
        return view('suadmin.login');
    }

    /**
     * Tangani permintaan login.
     */
    public function login(Request $request)
    {
        // Ambil input dari form
        $credentials = $request->only('email', 'password');

        // Logika hardcode untuk admin
        if ($credentials['email'] === 'admin' && $credentials['password'] === 'admin') {

            $request->session()->put('loggedInAsAdmin', true);

            return redirect()->intended($this->redirectTo);
        }

        // Jika gagal, kembali ke halaman sebelumnya dengan pesan error
        return back()->withErrors([
            'email' => 'ID atau Password yang Anda masukkan salah.',
        ]);
    }
}
