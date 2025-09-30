@extends('layouts.layout')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Автоматически подключаем сайдбар -->
        @include('layouts.partials.sidebar')
        
        <!-- Основной контент -->
        <div class="@auth col-md-9 @else col-12 @endauth">
            <!-- Заголовок и фильтры -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold text-gradient mb-1">
                        <i class="fas fa-newspaper me-2"></i>Все посты
                    </h2>
                    <p class="text-muted mb-0">Последние публикации и новости</p>
                </div>
                <div class="d-flex gap-2">
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-filter me-2"></i>Фильтр
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="?filter=all">Все посты</a></li>
                            <li><a class="dropdown-item" href="?filter=active">Активные</a></li>
                            <li><a class="dropdown-item" href="?filter=draft">Черновики</a></li>
                        </ul>
                    </div>
                    @if(Auth::check() && Auth::user()->is_admin)
                    <a href="/posts/create" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Новый пост
                    </a>
                    @endif
                </div>
            </div>

            <!-- Сетка постов -->
            <div class="row">
                @forelse($posts as $post)
                <div class="col-lg-6 col-xl-4 mb-4">
                    <div class="card post-card h-100 shadow-sm border-0 rounded-4">
                        <!-- Заголовок поста с тегом -->
                        <div class="card-header border-0 rounded-top-4 pb-0 pt-3 bg-transparent">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                @if($post->tag)
                                <span class="badge {{ $post->tag->badge_class ?? 'bg-primary' }} rounded-pill">
                                    @if($post->tag->icon_class)
                                    <i class="{{ $post->tag->icon_class }} me-1"></i>
                                    @endif
                                    {{ $post->tag->name }}
                                </span>
                                @endif

                            </div>
                            <h5 class="fw-bold text-dark mb-2 line-clamp-2">{{ $post->title }}</h5>
                        </div>

                        <!-- Контент поста -->
                        <div class="card-body pt-2">
                            <p class="text-muted mb-3 line-clamp-3">{{ Str::limit(strip_tags($post->content), 120) }}</p>
                            
                            <!-- Мета-информация -->
                            <div class="d-flex justify-content-between align-items-center text-muted small mb-3">
                                <span>
                                    <i class="fas fa-calendar me-1"></i>
                                    {{ $post->created_at->format('d.m.Y') }}
                                </span>
                                <span>
                                    <i class="fas fa-clock me-1"></i>
                                    {{ $post->created_at->format('H:i') }}
                                </span>
                            </div>
                        </div>

                        <!-- Футер карточки -->
                        <div class="card-footer border-0 rounded-bottom-4 bg-transparent pt-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-outline-primary btn-sm rounded-pill">
                                    <i class="fas fa-eye me-1"></i>Читать
                                </a>
                                @if(Auth::check() && Auth::user()->is_admin)
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary btn-sm rounded-pill" type="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('posts.edit', $post->id) }}">
                                                <i class="fas fa-edit me-2"></i>Редактировать
                                            </a>
                                        </li>
                                        <li>
                                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger" 
                                                        onclick="return confirm('Удалить этот пост?')">
                                                    <i class="fas fa-trash me-2"></i>Удалить
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <!-- Состояние пустого списка -->
                <div class="col-12">
                    <div class="card shadow-lg border-0 rounded-4">
                        <div class="card-body text-center py-5">
                            <i class="fas fa-newspaper fa-4x text-muted mb-4"></i>
                            <h4 class="text-muted mb-3">Постов пока нет</h4>
                            <p class="text-muted mb-4">Будьте первым, кто опубликует новость!</p>
                            @if(Auth::check() && Auth::user()->is_admin)
                            <a href="/posts/create" class="btn btn-primary btn-lg rounded-pill">
                                <i class="fas fa-plus me-2"></i>Создать первый пост
                            </a>
                            @else
                            <p class="text-muted">Ожидайте новостей от администрации</p>
                            @endif
                        </div>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Пагинация -->
            @if($posts->total() > $posts->perPage())
            <div class="d-flex justify-content-center mt-5">
                <nav aria-label="Page navigation">
                    <ul class="pagination shadow-sm rounded-pill">
                        {{-- Previous Page Link --}}
                        @if($posts->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link rounded-start-pill">
                                    <i class="fas fa-chevron-left"></i>
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link rounded-start-pill" href="{{ $posts->previousPageUrl() }}">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach(range(1, $posts->lastPage()) as $page)
                            @if($page == $posts->currentPage())
                                <li class="page-item active">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $posts->url($page) }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if($posts->hasMorePages())
                            <li class="page-item">
                                <a class="page-link rounded-end-pill" href="{{ $posts->nextPageUrl() }}">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link rounded-end-pill">
                                    <i class="fas fa-chevron-right"></i>
                                </span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
.text-gradient {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.post-card {
    transition: all 0.3s ease;
    border: 1px solid rgba(0,0,0,0.05);
}

.post-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    border-color: rgba(102, 126, 234, 0.2);
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.hover-item {
    transition: all 0.3s ease;
    border-left: 3px solid transparent;
}

.hover-item:hover {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-left: 3px solid #007bff;
    transform: translateX(5px);
}

.bg-gradient-blue {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.rounded-4 {
    border-radius: 1rem !important;
}

.rounded-top-4 {
    border-top-left-radius: 1rem !important;
    border-top-right-radius: 1rem !important;
}

.rounded-bottom-4 {
    border-bottom-left-radius: 1rem !important;
    border-bottom-right-radius: 1rem !important;
}

.pagination .page-link {
    border: none;
    margin: 0 2px;
    border-radius: 50%;
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
}

.pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-color: transparent;
}

.pagination .page-link:hover {
    background: #f8f9fa;
}

.text-purple {
    color: #6f42c1 !important;
}

/* Анимации */
.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
}
</style>

<script>
// Анимация появления карточек
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.post-card');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
        card.classList.add('fade-in');
    });
});

// Добавляем стиль для анимации
const style = document.createElement('style');
style.textContent = `
    .fade-in {
        animation: fadeInUp 0.6s ease-out;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
`;
document.head.appendChild(style);
</script>
@endsection