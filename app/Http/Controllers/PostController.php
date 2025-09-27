<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tag;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Post\CreatePostRequest;

class PostController extends Controller
{
    public function index(){
        $posts = Post::with('tag')->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function show($id){
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    public function create(){
        $tags = Tag::all();
        return view('posts.create', compact('tags'));
    }

    public function store(CreatePostRequest $request){
        $post = Post::create($request->validated());
        return redirect('/')->with('success', 'Пост успешно создан');
    }

    public function edit(){
        
    }

    public function update($id, Request $request){
        
    }

    public function destroy(Post $post){
        
    }
}
