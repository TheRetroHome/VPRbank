<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        return view('home');
    }

    public function aboutUs(){
        return view('static.aboutus');
    }

    public function contacts(){
        return view('static.contacts');
    }
}
