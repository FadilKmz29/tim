<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\support\facades\Auth;
use App\Models\User;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }
    public function authenticate(Request $req)
    {
        $req->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (Auth::guard('admin')->attempt(['email' => $req->email, 'password' => $req->password])) {
            if (Auth::guard('admin')->user()->role != 'admin') {
                Auth::guard('admin')->logout();
                return redirect()->route('admin.login')->with('error', 'Unautherise user. Access denied!');
            }
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('admin.login')->with('error', 'Something went wrong');
        }
    }
    public function register()
    {
        $user = new User();
        $user->name = 'Admin';
        $user->role = 'admin';
        $user->email = 'admin@gmail.com';
        $user->password = Hash::make('admin');
        $user->save();
        return redirect()->route('admin.login')->with('success', 'User created successfully');
    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'Logged out successfully');
    }
    public function form()
    {
        return view('admin.form');
    }
    public function table()
    {
        return view('admin.table');
    }
}
