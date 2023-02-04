<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->only([
            'username',
            'password',
        ]);

        if (!auth()->attempt($credentials)) {
            return back()->with('error', true);
        }

        return back();
    }
}
