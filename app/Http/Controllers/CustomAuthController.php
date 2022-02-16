<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class CustomAuthController extends Controller
{
    // render view form authentication
    public function index() {
        return view('handle-auth/login');
    }

    public function dashboard() {
        if (Auth::check()) {
            return view('handle-auth/dashboard');
        }

        return redirect('handle-auth/login');
    }

    public function registration() {
        return view('handle-auth/registration');
    }

    public function CustomRegistration(Request $request) {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect('handle-auth/dashboard');
    }

    public function create(array $data) {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function customLogin(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        // $remember = $request->has('remember') ? true : false; 

        if (Auth::attempt($credentials)) {
            return redirect()->intended('handle-auth/dashboard');
        }

        return redirect('handle-auth/login')->withErrors('Login details are not valid');
    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return redirect('handle-auth/dashboard');
    }

}
