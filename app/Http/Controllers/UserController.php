<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showLogin(){
        return view('login');
    }

    public function login(Request $request){
        $credentials = $request->only('username', 'password');
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect('/hospitals');
        }

       return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    public function showRegister(Request $request){
       
        return view('register');
    }

    public function register(Request $request){
        $data = $request->validate([
            'username' =>  ['required', Rule::unique('users', 'username')],
            'password' => 'required',
        ]);


        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        auth()->login($user);
        return redirect('/hospitals');
    }

    public function logout(){
        auth()->logout();
        return redirect('/login');
    }

}
