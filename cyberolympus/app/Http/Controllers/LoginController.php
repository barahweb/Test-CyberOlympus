<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){
        $ceklogin = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt($ceklogin)) {
            // dd('berhasil');
            $request->session()->regenerate();
            $request->session()->flash('status_text', 'Berhasil!');
            return redirect('dashboard')->with('status_icon', 'success')
                ->with('status', 'Anda Berhasil Login!');;
        } else {
            // dd('gagal');
            $request->session()->flash('status_text', 'Gagal Login!');
            return back()->with('status_icon', 'error')
                ->with('status', 'Email atau Password Salah!');
        }
    }
}
