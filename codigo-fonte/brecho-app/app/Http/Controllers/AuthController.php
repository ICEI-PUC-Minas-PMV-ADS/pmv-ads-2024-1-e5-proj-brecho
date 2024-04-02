<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth');
    }

    public function register()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $data = $request->only(['first_name', 'last_name', 'email', 'password', 'phone']);

        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        auth()->login($user);

        return redirect('/');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'As credenciais informadas estão incorretas!',
        ]);
    }

    public function logout()
    {
        auth()->logout();

        return redirect('/');
    }
}
