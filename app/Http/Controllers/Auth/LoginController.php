<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // redirect setelah login
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // login pakai name
    public function username()
    {
        return 'name';
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);
        $this->alert('Berhasil login!', 'success');
    }

    // override response jika login gagal
    protected function sendFailedLoginResponse(Request $request)
    {
        // Pakai alert global
        $this->alert('Username atau password salah!', 'error');

        return redirect()->back()
            ->withInput($request->only('name'));
    }

    public function showLoginForm()
    {
        return view('pages.auth.login');
    }
}
