<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ВПР Банк - Авторизация</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .auth-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 800px;
            width: 100%;
        }
        
        .auth-header {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            padding: 30px;
            text-align: center;
            color: white;
        }
        
        .auth-logo {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 10px;
        }
        
        .auth-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        
        .nav-tabs {
            border: none;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 0;
        }
        
        .nav-link {
            border: none !important;
            padding: 20px;
            font-weight: 600;
            color: #6c757d;
            transition: all 0.3s ease;
            border-radius: 0;
        }
        
        .nav-link.active {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white !important;
        }
        
        .nav-link:hover {
            color: #007bff;
        }
        
        .tab-content {
            padding: 30px;
        }
        
        .form-control {
            border-radius: 12px;
            padding: 15px 20px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
            font-size: 1rem;
        }
        
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        
        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
        }
        
        .input-group-text {
            background: transparent;
            border: 2px solid #e9ecef;
            border-right: none;
            border-radius: 12px 0 0 12px;
        }
        
        .btn-auth {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            border: none;
            border-radius: 12px;
            padding: 15px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            width: 100%;
        }
        
        .btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 123, 255, 0.3);
        }
        
        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0;
        }
        
        .form-check-input {
            width: 20px;
            height: 20px;
            border-radius: 5px;
            border: 2px solid #dee2e6;
        }
        
        .form-check-input:checked {
            background-color: #007bff;
            border-color: #007bff;
        }
        
        .forgot-link {
            color: #6c757d;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .forgot-link:hover {
            color: #007bff;
        }
        
        .back-btn {
            color: #6c757d;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
            display: inline-flex;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .back-btn:hover {
            color: #007bff;
        }
        
        .alert {
            border-radius: 12px;
            border: none;
            padding: 15px 20px;
        }
        
        .password-toggle {
            cursor: pointer;
            transition: color 0.3s ease;
        }
        
        .password-toggle:hover {
            color: #007bff;
        }
        
        @media (max-width: 768px) {
            .auth-container {
                margin: 20px;
            }
            
            .nav-link {
                padding: 15px;
                font-size: 0.9rem;
            }
            
            .tab-content {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Кнопка назад -->
                <a href="/" class="back-btn">
                    <i class="fas fa-arrow-left me-2"></i>Вернуться на главную
                </a>

                <!-- Основной контейнер -->
                <div class="auth-container">
                    <!-- Шапка -->
                    <div class="auth-header">
                        <div class="auth-logo">
                            <i class="fas fa-university me-2"></i>ВПР БАНК
                        </div>
                        <div class="auth-subtitle">
                            Ваша финансовая безопасность — наш приоритет
                        </div>
                    </div>

                    <!-- Табы -->
                    <ul class="nav nav-tabs nav-justified" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#login">
                                <i class="fas fa-sign-in-alt me-2"></i>Авторизация
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#register">
                                <i class="fas fa-user-plus me-2"></i>Регистрация
                            </a>
                        </li>
                    </ul>

                    <!-- Контент табов -->
                    <div class="tab-content">
                        <!-- Сообщения об ошибках -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <strong>Ошибка!</strong> Пожалуйста, проверьте введенные данные.
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Авторизация -->
                        <div class="tab-pane fade show active" id="login">
                            <form method="POST" action="{{ url('authorization/auth') }}">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Имя пользователя</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <input type="text" name="name" class="form-control" 
                                               value="{{ old('name') }}" 
                                               placeholder="Введите ваше имя" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Пароль</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                        <input type="password" name="password" class="form-control" 
                                               placeholder="Введите ваш пароль" required>
                                        <span class="input-group-text password-toggle">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="remember-forgot">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                        <label class="form-check-label" for="remember">
                                            Запомнить меня
                                        </label>
                                    </div>
                                    <a href="#" class="forgot-link">Забыли пароль?</a>
                                </div>

                                <button type="submit" class="btn btn-auth">
                                    <i class="fas fa-sign-in-alt me-2"></i>Войти в систему
                                </button>
                            </form>
                        </div>

                        <!-- Регистрация -->
                        <div class="tab-pane fade" id="register">
                            <form method="POST" action="{{ url('authorization/register') }}">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Имя пользователя</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <input type="text" name="name" class="form-control" 
                                               value="{{ old('name') }}" 
                                               placeholder="Придумайте имя пользователя" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Email адрес</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        <input type="email" name="email" class="form-control" 
                                               value="{{ old('email') }}" 
                                               placeholder="Введите ваш email" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Пароль</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                        <input type="password" name="password" class="form-control" 
                                               placeholder="Придумайте надежный пароль" required>
                                        <span class="input-group-text password-toggle">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Подтверждение пароля</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                        <input type="password" name="password_confirmation" class="form-control" 
                                               placeholder="Повторите пароль" required>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-auth">
                                    <i class="fas fa-user-plus me-2"></i>Создать аккаунт
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Переключение видимости пароля
        document.querySelectorAll('.password-toggle').forEach(toggle => {
            toggle.addEventListener('click', function() {
                const input = this.closest('.input-group').querySelector('input');
                const icon = this.querySelector('i');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.replace('fa-eye', 'fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.replace('fa-eye-slash', 'fa-eye');
                }
            });
        });

        // Автопереключение на регистрацию при ошибках
        @if($errors->any() && old('_token') && !old('name') && !old('email'))
            const registerTab = new bootstrap.Tab(document.querySelector('a[href="#register"]'));
            registerTab.show();
        @endif
    </script>
</body>
</html>