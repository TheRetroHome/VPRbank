<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getProfile(){
        $user = Auth::user()->load('transactions');
        return view('user.profile', compact('user'));
    }

    public function profile(){

    }
}
