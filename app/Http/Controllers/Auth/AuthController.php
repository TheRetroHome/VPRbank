<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\UserService;

class AuthController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService){
        $this->userService = $userService;
    }

    public function getAuth(){
        return view('AuthPages.login');
    }

    public function postAuth(LoginRequest $request){
        $credentials = $request->only('name', 'password');
        if($this->userService->attemptToLogin($credentials, $request->has('remember'))){
            $this->userService->regenerateSession($request);
            return redirect('/');
        }
        return back()->withErrors([
            'name' => 'Неверные учетные данные.',
        ])->withInput($request->except('password'));
    }

    public function postRegister(RegisterRequest $request){
        $this->userService->register($request->validated());

        return redirect('/')
        ->with('success', 'Регистрация пройдена успешно');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

}
