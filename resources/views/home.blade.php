<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная страница</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-custom {
            background-color: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
        }
        .user-menu {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #007bff;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Верхняя панель с меню пользователя -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">ВПР</a>
            
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('home') }}">Главная</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">О нас</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Контакты</a>
                    </li>
                </ul>
                
                <div class="user-menu">
                    @auth
                        <!-- Пользователь авторизован -->
                        <div class="d-flex align-items-center">
                            <div class="user-avatar me-2">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="me-3">Привет, {{ Auth::user()->name }}!</span>
                        </div>
                        
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                Выйти
                            </button>
                        </form>
                    @else
                        <!-- Пользователь не авторизован -->
                        <a href="{{ route('getAuth') }}" class="btn btn-outline-primary btn-sm me-2">
                            Авторизоваться
                        </a>
                        <a href="{{ route('getAuth') }}" class="btn btn-primary btn-sm">
                            Зарегистрироваться
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Основной контент -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-3">
                <!-- Сайдбар -->
                <div class="card">
                    <div class="card-header">
                        Меню
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <a href="" class="text-decoration-none">Профиль</a>
                            </li>
                            <li class="list-group-item">
                                <a href="" class="text-decoration-none">Настройки</a>
                            </li>
                            <li class="list-group-item">
                                <a href="" class="text-decoration-none">Сообщения</a>
                            </li>
                            @auth
                                <li class="list-group-item">
                                    <a href="" class="text-decoration-none">Панель управления</a>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-md-9">
                <!-- Основной контент -->
                <div class="card">
                    <div class="card-header">
                        <h2>Добро пожаловать на главную страницу!</h2>
                    </div>
                    <div class="card-body">
                        @auth
                            <div class="alert alert-success">
                                <h4>Вы авторизованы!</h4>
                                <p>Email: {{ Auth::user()->email }}</p>
                                <p>Имя пользователя: {{ Auth::user()->username }}</p>
                                <p>Дата регистрации: {{ Auth::user()->created_at->format('d.m.Y') }}</p>
                            </div>
                        @else
                            <div class="alert alert-info">
                                <h4>Добро пожаловать, гость!</h4>
                                <p>Для доступа ко всем функциям сайта, пожалуйста, 
                                   <a href="{{ route('getAuth') }}">авторизуйтесь</a> или 
                                   <a href="{{ route('getAuth') }}">зарегистрируйтесь</a>.
                                </p>
                            </div>
                        @endauth
                        
                        <h3>Контент главной страницы</h3>
                        <p>Здесь может быть любой контент вашего сайта...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Футер -->
    <footer class="bg-light text-center text-lg-start mt-5">
        <div class="text-center p-3">
            © 2024 ВПР. Все права защищены.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>