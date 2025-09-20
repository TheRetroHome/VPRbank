<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Post\CreatePostRequest;

class PostController extends Controller
{
    public function index(){
        $posts = Post::all();
        return view('posts.test', compact('posts'));
    }

    public function show(Post $post){
        
    }

    public function create(){
        return view('posts.create');
    }

    public function store(CreatePostRequest $request){
        $post = Post::create($request->validated());
        return redirect('/')->with('success', 'Пост успешно создан');
    }

    public function edit(){
        
    }

    public function update(Post $post, Request $request){
        
    }

    public function destroy(Post $post){
        
    }
}
