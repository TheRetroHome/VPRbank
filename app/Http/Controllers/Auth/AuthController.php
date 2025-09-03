<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function getAuth(){
        return view('AuthPages.login');
    }

    public function postAuth(Request $LoginRequest){

    }

    public function postRegister(Request $RegisterRequest){

    }
}
