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
    protected $redirectTo = '/suadmin/datamenara';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
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
        $credentials = $request->only('email', 'password');

        if ($credentials['email'] === 'admin' && $credentials['password'] === 'admin') {

            $request->session()->put('loggedInAsAdmin', true);

            return redirect()->intended($this->redirectTo);
        }

        return back()->withErrors([
            'email' => 'ID atau Password yang Anda masukkan salah.',
        ]);
    }
}
