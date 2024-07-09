<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function login_proses(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($data)){
            return redirect()->route('frontend.home');
        }else{
            return redirect()->route('login')->with('failed', 'Email atau Password Salah!');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('success', 'Anda Berhasil Logout!');
    }
 
    public function register(){
        return view('auth.register');
    }

    public function register_proses(Request $request){
        $request->validate([
            'nama'      => 'required',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:6',
            'no_telepon'=> 'required'
        ]);

        $data['nama']       = $request->nama;
        $data['email']      = $request->email;
        $data['password']   = Hash::make($request->password);
        $data['no_telepon'] = $request->no_telepon;

        User::create($data);

        $login = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($login)){
            return redirect()->route('login')->with('success', 'Akun Berhasil Dibuat!');
        }else{
            return redirect()->route('login')->with('failed', 'Email atau Password Salah!');
        }
    }
}
