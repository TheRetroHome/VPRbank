<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    /** Домашняя страница (основная на /)
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\View\View|object
     */
    public function home(){
        $posts = Post::homeStatic()
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
