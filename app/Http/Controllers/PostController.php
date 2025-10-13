<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tag;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;

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

    public function edit($id){
        $post = Post::findOrFail($id);
        $tags = Tag::all();
        return view('posts.edit', compact('post', 'tags'));
    }

    public function update($id, UpdatePostRequest $request){
        $validated = $request->validated();
        $post = Post::findOrFail($id);
        $post->update($validated);

        return redirect('posts/index');
    }

    public function destroy($id){
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect('posts/index');
    }
}
