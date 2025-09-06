<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserService{
    public function register(array $userData){
        $user = User::create([
            'name'      => $userData['name'],
            'email'     => $userData['email'],
            'password'  => Hash::make($userData['password'])
        ]);

        Auth::login($user);

        return $user;
    }

    public function attemptToLogin(array $credentials, bool $remember = false) : bool {
        return Auth::attempt($credentials, $remember);
    }

    public function regenerateSession($request) : void{
        $request->session()->regenerate();
    }
}