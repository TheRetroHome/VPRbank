<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function getAuth(){
        return view('AuthPages.login');
    }

    public function postAuth(LoginRequest $request){
        $credentials = $request->only('name', 'password');
        if(Auth::attempt($credentials, $request->has('remember'))){
            $request->session()->regenerate();
            return redirect('/');
        }
        return back()->withErrors([
            'name' => 'Неверные учетные данные.',
        ])->withInput($request->except('password'));
    }

    public function postRegister(RegisterRequest $request){
        $user = User::create([
            'name'  => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Auth::login($user);

        return redirect('/')
        ->with('success', 'Регистрация пройдена успешно');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

}
