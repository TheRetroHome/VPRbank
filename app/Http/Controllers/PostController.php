<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tag;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Services\PostService;

class PostController extends Controller
{
    protected $postService;
    public function __construct(PostService $postService){
        $this->postService = $postService;
    }
    public function index()
    {
        $posts = $this->postService->getPaginatedPosts();

        return view('posts.index', compact('posts'));
    }

    public function show($id)
    {
        $post = $this->postService->getPostById($id);

        return view('posts.show', compact('post'));
    }

    public function create()
    {
        $tags = $this->postService->getAllTags();

        return view('posts.create', compact('tags'));
    }

    public function store(CreatePostRequest $request)
    {
        $this->postService->createPost($request->validated());

        return redirect('/')->with('success', 'Пост успешно создан');
    }

    public function edit($id)
    {
        $post = $this->postService->getPostById($id);
        $tags = $this->postService->getAllTags();

        return view('posts.edit', compact('post', 'tags'));
    }

    public function update($id, UpdatePostRequest $request)
    {
        $this->postService->updatePost($id, $request->validated());

        return redirect()->route('posts.index')
                         ->with('success', 'Пост успешно обновлён');
    }

    public function destroy($id)
    {
        $this->postService->deletePost($id);

        return redirect()->route('posts.index')
                         ->with('success', 'Пост успешно удалён');
    }
}
