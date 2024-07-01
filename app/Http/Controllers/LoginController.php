<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:account')->except('logout');
    }

    public function formLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'nik' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('account')->attempt($credentials)) {
            $request->session()->regenerate();
            $account = Auth::guard('account')->user();
            if ($account->role == "Commerce") {
                return redirect()->intended(route('commerce.dashboard.index'));
            } else if ($account->role == 'Finance') {
                return redirect()->intended(route('finance.dashboard.index'));
            } else if ($account->role == 'GM') {
                return redirect()->intended(route('manager.dashboard'));
            } else if ($account->role == 'Admin') {
                return redirect()->intended(route('admin.dashboard'));
            } else {
                return redirect()->back()->with('error', 'NIK atau Password Salah');
            }
        }

        // // dd([$request->email, $request->password]);
        // if (Auth::guard('account')->attempt(['nik' => $request->nik, "password" => $request->password])) {
        //     return redirect()->intended(route('admin.dashboard.index'));
        // }
        return back()->with('error', 'NIK atau Password salah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}