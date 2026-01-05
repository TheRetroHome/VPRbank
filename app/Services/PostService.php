<?php
namespace App\Services;

use App\Models\Tag;
use App\Models\Post;

class PostService{
    /**
     * Получить список постов с пагинацией и тегами
     */
    public function getPaginatedPosts(int $perPage = 10)
    {
        return Post::with('tag')->latest()->paginate($perPage);
    }

    /**
     * Получить пост по ID или выбросить 404
     */
    public function getPostById(int $id): Post
    {
        return Post::findOrFail($id);
    }

    /**
     * Получить все теги для формы создания/редактирования
     */
    public function getAllTags(): \Illuminate\Support\Collection
    {
        return Tag::all();
    }

    /**
     * Создать новый пост
     */
    public function createPost(array $data): Post
    {
        return Post::create($data);
    }

    /**
     * Обновить существующий пост
     *
     * @throws ModelNotFoundException
     */
    public function updatePost(int $id, array $data): bool
    {
        $post = Post::findOrFail($id);
        return $post->update($data);
    }

    /**
     * Удалить пост
     *
     * @throws ModelNotFoundException
     */
    public function deletePost(int $id): bool
    {
        $post = Post::findOrFail($id);
        return $post->delete();
    }
}