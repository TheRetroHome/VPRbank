@extends('layouts.layout')
@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Сайдбар -->
        <div class="col-md-3">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4 py-3">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-bars me-2"></i>Меню пользователя</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item border-0 py-3 hover-item">
                            <a href="#" class="text-decoration-none text-dark d-flex align-items-center">
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
                        @endadmin
                        <li class="list-group-item border-0 py-3 hover-item">
                            <a href="#" class="text-decoration-none text-dark d-flex align-items-center">
                                <i class="fas fa-credit-card me-3 text-purple"></i>
                                <span class="fw-medium">Мои карты</span>
                            </a>
                        </li>
                        <li class="list-group-item border-0 py-3 hover-item">
                            <a href="#" class="text-decoration-none text-dark d-flex align-items-center">
                                <i class="fas fa-history me-3 text-secondary"></i>
                                <span class="fw-medium">История операций</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Блок с балансом -->
            @auth
            <div class="card shadow-lg border-0 rounded-4 mt-4 bg-gradient-blue">
                <div class="card-body text-center text-white">
                    <i class="fas fa-wallet fa-3x mb-3"></i>
                    <h4 class="fw-bold">Баланс</h4>
                    <h2 class="display-5 fw-bold">{{ Auth::user()->cash ?? 0 }} ₽</h2>
                    <div class="d-grid gap-2 mt-3">
                        <button class="btn btn-light btn-sm rounded-pill">
                            <i class="fas fa-plus me-1"></i>Пополнить
                        </button>
                    </div>
                </div>
            </div>
            @endauth
        </div>

        <!-- Основной контент -->
        <div class="col-md-9">
            <!-- Приветствие -->
            @auth
            <div class="card shadow-lg border-0 rounded-4 mb-4">
                <div class="card-header bg-gradient-primary text-white rounded-top-4 py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-bold">
                            <i class="fas fa-hand-wave me-2"></i>Добро пожаловать, {{ Auth::user()->name }}!
                        </h4>
                        <span class="badge bg-light text-primary fs-6">
                            <i class="fas fa-star me-1"></i>Премиум клиент
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
                                    <p class="mb-0 fw-bold">{{ Auth::user()->email }}</p>
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
                    <h5 class="mb-0 fw-bold"><i class="fas fa-newspaper me-2"></i>Новости ВПР Банка</h5>
                </div>
                <div class="card-body">
                    <!-- Новость 1 -->
                    <div class="news-item mb-4 pb-4 border-bottom">
                        <div class="d-flex align-items-start">
                            <div class="news-icon me-3">
                                <i class="fas fa-shield-alt fa-2x text-success"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="text-primary mb-1">Обновление безопасности</h6>
                                <p class="text-muted small mb-2">15 декабря 2024 • <span class="badge bg-success">Важно</span></p>
                                <p class="mb-2">Внедрена новая система двухфакторной аутентификации для повышенной защиты ваших счетов.</p>
                                <a href="#" class="text-decoration-none small">Подробнее →</a>
                            </div>
                        </div>
                    </div>

                    <!-- Новость 2 -->
                    <div class="news-item mb-4 pb-4 border-bottom">
                        <div class="d-flex align-items-start">
                            <div class="news-icon me-3">
                                <i class="fas fa-percentage fa-2x text-warning"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="text-primary mb-1">Повышение ставок по вкладам</h6>
                                <p class="text-muted small mb-2">10 декабря 2024 • <span class="badge bg-info">Финансы</span></p>
                                <p class="mb-2">С 1 января 2025 года повышаются процентные ставки по всем депозитным программам.</p>
                                <a href="#" class="text-decoration-none small">Подробнее →</a>
                            </div>
                        </div>
                    </div>

                    <!-- Новость 3 -->
                    <div class="news-item mb-4 pb-4 border-bottom">
                        <div class="d-flex align-items-start">
                            <div class="news-icon me-3">
                                <i class="fas fa-mobile-alt fa-2x text-primary"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="text-primary mb-1">Новое мобильное приложение</h6>
                                <p class="text-muted small mb-2">5 декабря 2024 • <span class="badge bg-primary">Технологии</span></p>
                                <p class="mb-2">Вышло обновленное приложение ВПР Банка с улучшенным интерфейсом и новыми функциями.</p>
                                <a href="#" class="text-decoration-none small">Подробнее →</a>
                            </div>
                        </div>
                    </div>

                    <!-- Новость 4 -->
                    <div class="news-item">
                        <div class="d-flex align-items-start">
                            <div class="news-icon me-3">
                                <i class="fas fa-gift fa-2x text-danger"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="text-primary mb-1">Сезонные акции</h6>
                                <p class="text-muted small mb-2">1 декабря 2024 • <span class="badge bg-danger">Акция</span></p>
                                <p class="mb-2">Специальные новогодние предложения для клиентов ВПР Банка. Получите кэшбэк до 10%.</p>
                                <a href="#" class="text-decoration-none small">Подробнее →</a>
                            </div>
                        </div>
                    </div>
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
}

.news-item:hover {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 1rem;
    margin: -1rem;
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
</style>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

@endsection