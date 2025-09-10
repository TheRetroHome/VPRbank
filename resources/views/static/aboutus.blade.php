@extends('layouts.layout')
@section('content')
<div class="container py-5">
    <!-- Заголовок -->
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold text-primary">О ВПР Банке</h1>
        <p class="lead text-muted">Ваша финансовая безопасность — наш главный приоритет</p>
    </div>

    <!-- Основной контент -->
    <div class="row align-items-center mb-5">
        <div class="col-lg-6">
            <div class="about-hero">
                <h2 class="fw-bold mb-4">Банк, которому можно доверять</h2>
                <p class="fs-5 text-secondary">
                    ВПР Банк — это современная финансовая организация, которая сочетает в себе 
                    передовые технологии безопасности и вековые традиции банковского дела. 
                    Мы создали экосистему, где ваши средства защищены лучше, чем где-либо еще.
                </p>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="text-center">
                <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                     alt="Безопасность ВПР Банка" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>

    <!-- Преимущества -->
    <div class="row mb-5">
        <div class="col-12">
            <h3 class="text-center mb-4 fw-bold">Почему выбирают ВПР Банк?</h3>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-shield-alt fa-3x text-primary"></i>
                    </div>
                    <h5 class="card-title">Максимальная защита</h5>
                    <p class="card-text">
                        Многоуровневая система шифрования и биометрическая аутентификация. 
                        Ваши данные недоступны третьим лицам.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-bolt fa-3x text-warning"></i>
                    </div>
                    <h5 class="card-title">Мгновенные операции</h5>
                    <p class="card-text">
                        Переводы, платежи и инвестиции — все операции выполняются 
                        в режиме реального времени без задержек.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-globe fa-3x text-success"></i>
                    </div>
                    <h5 class="card-title">Доступность 24/7</h5>
                    <p class="card-text">
                        Круглосуточный доступ к счетам из любой точки мира. 
                        Банк, который всегда с вами.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Технологии безопасности -->
    <div class="security-section bg-light py-5 rounded">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h3 class="fw-bold mb-4">Технологии будущего уже сегодня</h3>
                <p class="fs-5 mb-4">
                    Мы используем квантовое шифрование и блокчейн-технологии для защиты 
                    каждой транзакции. Наша система безопасности прошла аудит ведущих 
                    международных экспертов.
                </p>
                <div class="d-flex justify-content-center flex-wrap gap-3">
                    <span class="badge bg-primary fs-6 p-3">256-битное шифрование</span>
                    <span class="badge bg-success fs-6 p-3">Multi-Factor Auth</span>
                    <span class="badge bg-warning fs-6 p-3">AI Fraud Detection</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Статистика -->
    <div class="row text-center mt-5">
        <div class="col-md-3 mb-4">
            <div class="stat-item">
                <h2 class="display-4 fw-bold text-primary">10M+</h2>
                <p class="text-muted">Довольных клиентов</p>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="stat-item">
                <h2 class="display-4 fw-bold text-success">$500B+</h2>
                <p class="text-muted">Активов под управлением</p>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="stat-item">
                <h2 class="display-4 fw-bold text-warning">99.99%</h2>
                <p class="text-muted">Аптайм системы</p>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="stat-item">
                <h2 class="display-4 fw-bold text-info">15+</h2>
                <p class="text-muted">Лет на рынке</p>
            </div>
        </div>
    </div>

    <!-- Призыв к действию -->
    <div class="text-center mt-5">
        <div class="cta-section p-5 bg-primary text-white rounded">
            <h3 class="fw-bold mb-3">Присоединяйтесь к ВПР Банку сегодня!</h3>
            <p class="fs-5 mb-4">Станьте частью сообщества, которое ценит безопасность и инновации</p>
            <a href="" class="btn btn-light btn-lg px-5 py-3 fw-bold">
                Открыть счет
            </a>
        </div>
    </div>
</div>

<style>
.about-hero {
    padding: 2rem;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border-radius: 15px;
    border-left: 4px solid #007bff;
}

.security-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.stat-item {
    transition: transform 0.3s ease;
}

.stat-item:hover {
    transform: translateY(-5px);
}

.cta-section {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
}
</style>

<!-- Font Awesome для иконок -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

@endsection