@foreach($posts as $post)
    <div class="post">
        <h2>{{ $post->title }}</h2>
        <p>{{ $post->content }}</p>
        <p>{{ $post->is_active }}</p>
        <small>Пост создан: {{ $post->created_at }}</small>
    </div>
@endforeach
