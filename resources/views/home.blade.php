@extends('layouts.layout')
@section('content')
<div class="container py-4">
    <div class="row">
        @auth
        <!-- Сайдбар для авторизованных -->
        <div class="col-md-3">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4 py-3">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-bars me-2"></i>Меню пользователя</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item border-0 py-3 hover-item">
                            <a href="users/profile" class="text-decoration-none text-dark d-flex align-items-center">
                                <i class="fas fa-user-circle me-3 text-primary"></i>
                                <span class="fw-medium">Профиль</span>
                            </a>
                        </li>
                        <li class="list-group-item border-0 py-3 hover-item">
                            <a href="#" class="text-decoration-none text-dark d-flex align-items-center">
                                <i class="fas fa-cog me-3 text-warning"></i>
                                <span class="fw-medium">Настройки</span>
                            </a>
                        </li>
                        <li class="list-group-item border-0 py-3 hover-item">
                            <a href="#" class="text-decoration-none text-dark d-flex align-items-center">
                                <i class="fas fa-envelope me-3 text-info"></i>
                                <span class="fw-medium">Сообщения</span>
                                <span class="badge bg-danger ms-auto">3</span>
                            </a>
                        </li>
                        @admin
                        <li class="list-group-item border-0 py-3 hover-item">
                            <a href="/admin/info" class="text-decoration-none text-dark d-flex align-items-center">
                                <i class="fas fa-shield-alt me-3 text-success"></i>
                                <span class="fw-medium">Панель управления</span>
                                <span class="badge bg-success ms-auto">ADMIN</span>
                            </a>
                        </li>
                        <li class="list-group-item border-0 py-3 hover-item">
                            <a href="/posts/create" class="text-decoration-none text-dark d-flex align-items-center">
                                <i class="fas fa-edit me-3 text-success"></i>
                                <span class="fw-medium">Создание постов</span>
                                <span class="badge bg-success ms-auto">ADMIN</span>
                            </a>
                        </li>
                        @endadmin
                        <li class="list-group-item border-0 py-3 hover-item">
                            <a href="#" class="text-decoration-none text-dark d-flex align-items-center">
                                <i class="fas fa-credit-card me-3 text-purple"></i>
                                <span class="fw-medium">Мои карты</span>
                            </a>
                        </li>
                        <li class="list-group-item border-0 py-3 hover-item">
                            <a href="/money/moneyHistory" class="text-decoration-none text-dark d-flex align-items-center">
                                <i class="fas fa-history me-3 text-secondary"></i>
                                <span class="fw-medium">История операций</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Блок с балансом -->
            <div class="card shadow-lg border-0 rounded-4 mt-4 bg-gradient-blue">
                <div class="card-body text-center text-white">
                    <i class="fas fa-wallet fa-3x mb-3"></i>
                    <h4 class="fw-bold">Баланс</h4>
                    <h2 class="display-5 fw-bold">{{ Auth::user()->cash ?? 0 }} ₽</h2>
                    <div class="d-grid gap-2 mt-3">
                        <a href="/money/money" class="btn btn-light btn-sm rounded-pill">
                            <i class="fas fa-plus me-1"></i>Пополнить
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endauth

        <!-- Основной контент -->
        <div class="@auth col-md-9 @else col-12 @endauth">
            <!-- Приветствие -->
            @auth
            <div class="card shadow-lg border-0 rounded-4 mb-4">
                <div class="card-header bg-gradient-primary text-white rounded-top-4 py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-bold">
                            <i class="fas fa-hand-wave me-2"></i>Добро пожаловать, {{ Auth::user()->name }}!
                        </h4>
                        <span class="badge bg-light text-primary fs-6">
                            <i class="fas fa-star me-1"></i>{{ Auth::user()->role }}
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-card">
                                <i class="fas fa-envelope text-primary"></i>
                                <div>
                                    <small>Email</small>
                                    <p class="mb-0 fw-bold text-break">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-card">
                                <i class="fas fa-calendar-alt text-success"></i>
                                <div>
                                    <small>Дата регистрации</small>
                                    <p class="mb-0 fw-bold">{{ Auth::user()->created_at->format('d.m.Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="card shadow-lg border-0 rounded-4 mb-4">
                <div class="card-header bg-gradient-info text-white rounded-top-4 py-4">
                    <h4 class="mb-0 fw-bold"><i class="fas fa-door-open me-2"></i>Добро пожаловать, гость!</h4>
                </div>
                <div class="card-body text-center py-5">
                    <i class="fas fa-user-lock fa-4x text-muted mb-4"></i>
                    <h5 class="text-muted mb-3">Для доступа ко всем функциям</h5>
                    <div class="d-grid gap-2 d-md-block">
                        <a href="/authorization" class="btn btn-primary btn-lg rounded-pill me-md-2">
                            <i class="fas fa-sign-in-alt me-2"></i>Войти
                        </a>
                        <a href="/authorization" class="btn btn-outline-primary btn-lg rounded-pill">
                            <i class="fas fa-user-plus me-2"></i>Регистрация
                        </a>
                    </div>
                </div>
            </div>
            @endauth

            <!-- Лента новостей -->
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-gradient-dark text-white rounded-top-4 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-newspaper me-2"></i>Новости ВПР Банка
                        </h5>
                        <a href="{{ route('posts.index') }}" class="btn btn-outline-light btn-sm rounded-pill">
                            <i class="fas fa-list me-1"></i>Все посты
                            <span class="badge bg-light text-dark ms-1">{{ $posts->total() }}</span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @forelse($posts->take(3) as $post)
                        <div class="news-item mb-4 pb-4 border-bottom position-relative">
                            <!-- Бейдж тега -->
                            @if($post->tag)
                            <div class="position-absolute top-0 end-0">
                                <span class="badge {{ $post->tag->badge_class ?? 'bg-primary' }} rounded-pill">
                                    @if($post->tag->icon_class)
                                    <i class="{{ $post->tag->icon_class }} me-1"></i>
                                    @endif
                                    {{ $post->tag->name }}
                                </span>
                            </div>
                            @endif

                            <div class="d-flex align-items-start">
                                <div class="news-icon me-3">
                                    @if($post->tag)
                                        <i class="fas fa-tag fa-2x {{ $post->tag->badge_class ? 'text-' . str_replace('bg-', '', $post->tag->badge_class) : 'text-primary' }}"></i>
                                    @else
                                        <i class="fas fa-file-alt fa-2x text-muted"></i>
                                    @endif
                                </div>
                                <div class="flex-grow-1 min-width-0"> 
                                    <div class="d-flex align-items-start justify-content-between mb-2 flex-wrap"> 
                                        <h6 class="text-primary mb-0 fw-bold text-break pe-2">{{ $post->title }}</h6> 
                                    </div>
                                    <p class="text-muted small mb-2">
                                        <i class="fas fa-calendar me-1"></i>
                                        {{ $post->created_at->format('d.m.Y H:i') }}
                                    </p>
                                    <p class="mb-2 text-dark text-break word-wrap">{{ Str::limit(strip_tags($post->content), 100) }}</p> 
                                    <div class="d-flex justify-content-between align-items-center flex-wrap"> 
                                        <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none text-primary fw-medium mb-1"> 
                                            <i class="fas fa-arrow-right me-1"></i>Читать полностью
                                        </a>
                                        <small class="text-muted flex-shrink-0"> 
                                            <i class="fas fa-clock me-1"></i>
                                            {{ $post->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted mb-2">Нет новостей для отображения</h5>
                            <p class="text-muted">Следите за обновлениями, скоро здесь появятся новости</p>
                            @admin
                            <a href="/posts/create" class="btn btn-primary mt-2">
                                <i class="fas fa-plus me-2"></i>Создать первую новость
                            </a>
                            @endadmin
                        </div>
                    @endforelse

                    <!-- Кнопка "Все посты" внизу для мобильных -->
                    @if($posts->count() > 3)
                    <div class="d-block d-md-none text-center mt-4">
                        <a href="{{ route('posts.index') }}" class="btn btn-outline-primary btn-sm rounded-pill">
                            <i class="fas fa-list me-1"></i>Показать все посты
                            <span class="badge bg-primary ms-1">{{ $posts->total() }}</span>
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
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

.bg-gradient-primary {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
}

.bg-gradient-info {
    background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
}

.bg-gradient-dark {
    background: linear-gradient(135deg, #343a40 0%, #23272b 100%);
}

.info-card {
    display: flex;
    align-items: center;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 12px;
    margin-bottom: 1rem;
}

.info-card i {
    font-size: 1.5rem;
    margin-right: 1rem;
}

.news-item {
    transition: all 0.3s ease;
    padding: 0.5rem;
    border-radius: 12px;
}

.news-item:hover {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    transform: translateX(5px);
}

.news-icon {
    flex-shrink: 0;
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(0, 123, 255, 0.1);
    border-radius: 12px;
}

.text-purple {
    color: #6f42c1 !important;
}

.rounded-4 {
    border-radius: 1rem !important;
}

.rounded-top-4 {
    border-top-left-radius: 1rem !important;
    border-top-right-radius: 1rem !important;
}

.btn-outline-light:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: rgba(255, 255, 255, 0.3);
}

/* Решение проблемы с длинными словами */
.min-width-0 {
    min-width: 0;
}

.text-break {
    word-break: break-word;
    overflow-wrap: break-word;
}

.word-wrap {
    word-wrap: break-word;
}

.flex-shrink-0 {
    flex-shrink: 0;
}

/* Анимации */
.news-item {
    animation: fadeInUp 0.5s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Адаптивность */
@media (max-width: 768px) {
    .news-item {
        padding: 1rem;
        margin: 0 -1rem;
    }
    
    .news-icon {
        width: 50px;
        height: 50px;
    }
    
    .news-icon i {
        font-size: 1.5rem !important;
    }
    
    .text-break {
        word-break: break-all;
    }
}

/* Центрирование для неавторизованных */
.col-12 .card {
    max-width: 100%;
}

/* Плавные переходы при авторизации */
.card {
    transition: all 0.3s ease;
}
</style>

<script>
// Анимация появления новостей
document.addEventListener('DOMContentLoaded', function() {
    const newsItems = document.querySelectorAll('.news-item');
    newsItems.forEach((item, index) => {
        item.style.animationDelay = `${index * 0.2}s`;
    });
});
</script>
@endsection