@extends('layouts.layout')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <!-- Хлебные крошки -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/" class="text-decoration-none"><i class="fas fa-home me-1"></i>Главная</a></li>
                    <li class="breadcrumb-item"><a href="/posts/index" class="text-decoration-none"><i class="fas fa-newspaper me-1"></i>Посты</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Просмотр поста</li>
                </ol>
            </nav>

            <!-- Карточка поста -->
            <div class="card shadow-lg post-card">
                <div class="card-header bg-gradient-primary text-white py-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <h1 class="h2 mb-2">{{ $post->title }}</h1>
                            <div class="d-flex flex-wrap gap-3 align-items-center">
                                @if($post->tag)
                                <span class="badge {{ $post->tag->badge_class ?? 'bg-primary' }} rounded-pill">
                                    @if($post->tag->icon_class)
                                    <i class="{{ $post->tag->icon_class }} me-1"></i>
                                    @endif
                                    {{ $post->tag->name }}
                                </span>
                                @endif  
                                <span class="text-white-50"><i class="fas fa-calendar me-1"></i>{{ $post->created_at->format('d.m.Y H:i') }}</span>
                                <span class="text-white-50"><i class="fas fa-clock me-1"></i>{{ $post->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm rounded-circle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i>Редактировать</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-share me-2"></i>Поделиться</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-2"></i>Удалить</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card-body p-5">
                    <!-- Содержание поста -->
                    <article class="post-content">
                        {!! nl2br(e($post->content)) !!}
                    </article>

                    <!-- Статистика -->
                    <div class="row text-center mt-5 pt-4 border-top">
                        <div class="col-4">
                            <div class="stat-number text-primary">{{ rand(100, 1000) }}</div>
                            <div class="stat-label">Просмотров</div>
                        </div>
                        <div class="col-4">
                            <div class="stat-number text-success">{{ rand(5, 50) }}</div>
                            <div class="stat-label">Лайков</div>
                        </div>
                        <div class="col-4">
                            <div class="stat-number text-info">{{ rand(3, 30) }}</div>
                            <div class="stat-label">Комментариев</div>
                        </div>
                    </div>
                </div>

                <!-- Футер карточки -->
                <div class="card-footer bg-light py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-heart me-1"></i>Нравится
                            </button>
                            <button class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-comment me-1"></i>Комментировать
                            </button>
                            <button class="btn btn-outline-info btn-sm">
                                <i class="fas fa-share me-1"></i>Поделиться
                            </button>
                        </div>
                        <div class="text-muted small">
                            <i class="fas fa-sync-alt me-1"></i>Обновлено: {{ $post->updated_at->format('d.m.Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Блок действий -->
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                <a href="/" class="btn btn-outline-secondary me-md-2">
                    <i class="fas fa-arrow-left me-2"></i>Назад к списку
                </a>
                <a href="" class="btn btn-primary">
                    <i class="fas fa-edit me-2"></i>Редактировать
                </a>
            </div>

            <!-- Комментарии -->
            <div class="card shadow-sm mt-5">
                <div class="card-header bg-gradient-info text-white">
                    <h5 class="mb-0"><i class="fas fa-comments me-2"></i>Комментарии (3)</h5>
                </div>
                <div class="card-body">
                    <!-- Форма комментария -->
                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0">
                            <div class="avatar-sm">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <textarea class="form-control" rows="2" placeholder="Напишите ваш комментарий..."></textarea>
                            <div class="d-flex justify-content-end mt-2">
                                <button class="btn btn-primary btn-sm">Отправить</button>
                            </div>
                        </div>
                    </div>

                    <!-- Список комментариев -->
                    <div class="comment-list">
                        @for($i = 1; $i <= 3; $i++)
                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0">
                                <div class="avatar-sm">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <h6 class="fw-bold mb-1">Пользователь {{ $i }}</h6>
                                    <small class="text-muted">2{{ $i }} минут назад</small>
                                </div>
                                <p class="mb-1">Отличный пост! Очень полезная информация, спасибо автору за качественный контент.</p>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-sm btn-outline-primary">Ответить</button>
                                    <button class="btn btn-sm btn-outline-danger"><i class="fas fa-heart"></i></button>
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.post-card {
    border: none;
    border-radius: 20px;
}

.card-header {
    border-radius: 20px 20px 0 0 !important;
    border: none;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
}

.bg-gradient-info {
    background: linear-gradient(135deg, #17a2b8 0%, #138496 100%) !important;
}

.post-content {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #2d3748;
}

.post-content p {
    margin-bottom: 1.5rem;
}

.stat-number {
    font-size: 1.8rem;
    font-weight: 800;
    margin-bottom: 0.2rem;
}

.stat-label {
    font-size: 0.9rem;
    color: #6c757d;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.avatar-sm {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
}

.breadcrumb {
    background: transparent;
    padding: 0;
}

.breadcrumb-item a {
    color: #667eea;
    transition: color 0.3s ease;
}

.breadcrumb-item a:hover {
    color: #5a67d8;
}

.btn {
    border-radius: 10px;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
}

.comment-list {
    max-height: 400px;
    overflow-y: auto;
}

.comment-list::-webkit-scrollbar {
    width: 6px;
}

.comment-list::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.comment-list::-webkit-scrollbar-thumb {
    background: #667eea;
    border-radius: 3px;
}

.comment-list::-webkit-scrollbar-thumb:hover {
    background: #5a67d8;
}

/* Анимации */
.post-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.post-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
}

/* Адаптивность */
@media (max-width: 768px) {
    .card-body {
        padding: 2rem !important;
    }
    
    .stat-number {
        font-size: 1.4rem;
    }
    
    .d-flex.gap-3 {
        gap: 1rem !important;
    }
}
</style>
@endsection