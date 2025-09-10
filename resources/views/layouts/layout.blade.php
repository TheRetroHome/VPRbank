<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ВПР Банк - Надёжность и инновации</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .navbar-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            padding: 0.5rem 0;
        }
        
        .navbar-brand {
            font-weight: 800;
            font-size: 1.8rem;
            color: #fff !important;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
        }
        
        .navbar-brand:hover {
            transform: scale(1.05);
        }
        
        .nav-link {
            color: rgba(255,255,255,0.9) !important;
            font-weight: 500;
            padding: 0.5rem 1rem;
            margin: 0 0.2rem;
            border-radius: 25px;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            background: rgba(255,255,255,0.15);
            transform: translateY(-2px);
            color: #fff !important;
        }
        
        .nav-link.active {
            background: rgba(255,255,255,0.2);
            color: #fff !important;
        }
        
        .user-menu {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.1rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }
        
        .user-avatar:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(0,0,0,0.3);
        }
        
        .btn-nav {
            border-radius: 25px;
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        
        .btn-nav-primary {
            background: linear-gradient(135deg, #00b894 0%, #00a382 100%);
            color: white;
            border: none;
        }
        
        .btn-nav-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
            background: linear-gradient(135deg, #00a382 0%, #008f72 100%);
        }
        
        .btn-nav-outline {
            background: transparent;
            border: 2px solid rgba(255,255,255,0.8);
            color: rgba(255,255,255,0.9);
        }
        
        .btn-nav-outline:hover {
            background: rgba(255,255,255,0.1);
            border-color: #fff;
            color: #fff;
            transform: translateY(-2px);
        }
        
        .btn-nav-danger {
            background: linear-gradient(135deg, #ff7675 0%, #fd79a8 100%);
            color: white;
            border: none;
        }
        
        .btn-nav-danger:hover {
            background: linear-gradient(135deg, #fd79a8 0%, #e84393 100%);
            transform: translateY(-2px);
        }
        
        .welcome-text {
            color: rgba(255,255,255,0.9);
            font-weight: 500;
            margin-right: 1rem;
        }
        
        .notification-badge {
            position: relative;
            top: -8px;
            right: -8px;
            background: #ff4757;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .navbar-toggler {
            border: none;
            color: rgba(255,255,255,0.8);
        }
        
        .alert-notification {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        footer {
            background: linear-gradient(135deg, #2d3436 0%, #2c3e50 100%);
            color: white;
            padding: 2rem 0;
            margin-top: 3rem;
        }
    </style>
</head>
<body>
    <!-- Верхняя панель с меню пользователя -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <!-- Логотип и бренд -->
            <a class="navbar-brand" href="/">
                <i class="fas fa-university me-2"></i>ВПР БАНК
            </a>
            
            <!-- Кнопка для мобильных -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <i class="fas fa-bars"></i>
            </button>
            
            <!-- Основное меню -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">
                            <i class="fas fa-home me-1"></i>Главная
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('aboutUs') ? 'active' : '' }}" href="/aboutUs">
                            <i class="fas fa-info-circle me-1"></i>О нас
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('contacts') ? 'active' : '' }}" href="/contacts">
                            <i class="fas fa-phone me-1"></i>Контакты
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('services') ? 'active' : '' }}" href="/services">
                            <i class="fas fa-credit-card me-1"></i>Услуги
                        </a>
                    </li>
                </ul>
                
                <!-- Уведомления -->
                @if(session('success'))
                <div class="alert alert-success alert-notification alert-dismissible fade show me-3" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-notification alert-dismissible fade show me-3" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif
                
                <!-- Меню пользователя -->
                <div class="user-menu">
                    @auth
                    <!-- Пользователь авторизован -->
                    <div class="d-flex align-items-center">
                        <div class="user-avatar me-2">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <span class="welcome-text">Привет, {{ Auth::user()->name }}!</span>
                    </div>
                    
                    <form action="/authorization/logout" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-nav btn-nav-danger">
                            <i class="fas fa-sign-out-alt me-1"></i>Выйти
                        </button>
                    </form>
                    @else
                    <!-- Пользователь не авторизован -->
                    <a href="/authorization" class="btn btn-nav btn-nav-outline me-2">
                        <i class="fas fa-sign-in-alt me-1"></i>Войти
                    </a>
                    <a href="/authorization" class="btn btn-nav btn-nav-primary">
                        <i class="fas fa-user-plus me-1"></i>Регистрация
                    </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Футер -->
    <footer class="text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold mb-3"><i class="fas fa-university me-2"></i>ВПР Банк</h5>
                    <p>Ваша финансовая безопасность — наш главный приоритет</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold mb-3">Контакты</h5>
                    <p><i class="fas fa-phone me-2"></i>+7 (800) 555-35-35</p>
                    <p><i class="fas fa-envelope me-2"></i>info@vpr-bank.ru</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold mb-3">Мы в соцсетях</h5>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="#" class="text-white fs-4"><i class="fab fa-vk"></i></a>
                        <a href="#" class="text-white fs-4"><i class="fab fa-telegram"></i></a>
                        <a href="#" class="text-white fs-4"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4 bg-light">
            <p class="mb-0">© 2024 ВПР Банк. Все права защищены. Лицензия ЦБ РФ № 1234</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>