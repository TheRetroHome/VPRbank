<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function home(){
        $posts = Post::with('tag')
        ->orderBy('created_at', 'desc')
        ->paginate($this->paginate);
        
        return view('home', compact('posts'));
    }

    public function aboutUs(){
        return view('static.aboutus');
    }

    public function contacts(){
        return view('static.contacts');
    }

    public function service(){
        return view('static.service');
    }
}
