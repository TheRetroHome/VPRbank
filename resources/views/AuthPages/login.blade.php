<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ВПР Банк - Авторизация</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --dark-blue: #2c3e50;
            --light-blue: #3498db;
            --success: #2ecc71;
            --warning: #f39c12;
            --danger: #e74c3c;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', 'Segoe UI', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="rgba(255,255,255,0.05)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            animation: grain 8s steps(10) infinite;
        }
        
        @keyframes grain {
            0%, 100% { transform: translate(0, 0); }
            10% { transform: translate(-5%, -5%); }
            20% { transform: translate(-10%, 5%); }
            30% { transform: translate(5%, -10%); }
            40% { transform: translate(-5%, 15%); }
            50% { transform: translate(-10%, 5%); }
            60% { transform: translate(15%, 0); }
            70% { transform: translate(0, 10%); }
            80% { transform: translate(-15%, 0); }
            90% { transform: translate(10%, 5%); }
        }
        
        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }
        
        .shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
            animation: float 15s infinite ease-in-out;
        }
        
        .shape:nth-child(1) {
            width: 300px;
            height: 300px;
            background: var(--light-blue);
            top: -150px;
            left: -150px;
            animation-delay: 0s;
        }
        
        .shape:nth-child(2) {
            width: 200px;
            height: 200px;
            background: var(--success);
            bottom: -100px;
            right: -100px;
            animation-delay: -5s;
        }
        
        .shape:nth-child(3) {
            width: 150px;
            height: 150px;
            background: var(--warning);
            top: 50%;
            left: -75px;
            animation-delay: -10s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        
        .auth-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            max-width: 450px;
            width: 100%;
            position: relative;
            z-index: 2;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transform: translateY(0);
            transition: all 0.4s ease;
        }
        
        .auth-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
        }
        
        .auth-header {
            background: var(--primary-gradient);
            padding: 40px 30px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .auth-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: pulse 4s infinite ease-in-out;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }
        
        .auth-logo {
            font-size: 2.8rem;
            font-weight: 800;
            margin-bottom: 15px;
            position: relative;
            z-index: 2;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .auth-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            font-weight: 300;
            position: relative;
            z-index: 2;
        }
        
        .nav-tabs {
            border: none;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 0;
            position: relative;
            z-index: 2;
        }
        
        .nav-link {
            border: none !important;
            padding: 25px;
            font-weight: 600;
            color: #6c757d;
            transition: all 0.4s ease;
            border-radius: 0;
            position: relative;
            overflow: hidden;
            font-size: 1.1rem;
        }
        
        .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 4px;
            background: var(--primary-gradient);
            transition: all 0.4s ease;
            transform: translateX(-50%);
            border-radius: 4px 4px 0 0;
        }
        
        .nav-link.active {
            background: transparent !important;
            color: var(--dark-blue) !important;
        }
        
        .nav-link.active::before {
            width: 80%;
        }
        
        .nav-link:hover {
            color: var(--dark-blue);
            background: rgba(255, 255, 255, 0.5) !important;
        }
        
        .tab-content {
            padding: 40px 35px;
        }
        
        .form-group {
            margin-bottom: 25px;
            position: relative;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--dark-blue);
            margin-bottom: 12px;
            display: block;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .input-group {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }
        
        .input-group:focus-within {
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.2);
            transform: translateY(-2px);
        }
        
        .form-control {
            border: none;
            border-radius: 15px;
            padding: 18px 20px;
            font-size: 1.05rem;
            background: #fff;
            transition: all 0.3s ease;
            height: 60px;
        }
        
        .form-control:focus {
            box-shadow: none;
            background: #f8f9fa;
        }
        
        .input-group-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 0 20px;
            min-width: 60px;
            justify-content: center;
            font-size: 1.2rem;
        }
        
        .password-toggle {
            background: transparent !important;
            color: #6c757d !important;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .password-toggle:hover {
            color: var(--light-blue) !important;
            transform: scale(1.1);
        }
        
        .btn-auth {
            background: var(--primary-gradient);
            border: none;
            border-radius: 15px;
            padding: 18px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.4s ease;
            width: 100%;
            color: white;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }
        
        .btn-auth::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: all 0.6s ease;
        }
        
        .btn-auth:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(102, 126, 234, 0.4);
        }
        
        .btn-auth:hover::before {
            left: 100%;
        }
        
        .btn-auth:active {
            transform: translateY(-1px);
        }
        
        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 25px 0;
        }
        
        .form-check {
            display: flex;
            align-items: center;
        }
        
        .form-check-input {
            width: 22px;
            height: 22px;
            border-radius: 6px;
            border: 2px solid #dee2e6;
            margin-right: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .form-check-input:checked {
            background: var(--primary-gradient);
            border-color: transparent;
        }
        
        .form-check-label {
            color: #6c757d;
            font-weight: 500;
            cursor: pointer;
        }
        
        .forgot-link {
            color: var(--light-blue);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .forgot-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--light-blue);
            transition: all 0.3s ease;
        }
        
        .forgot-link:hover {
            color: var(--dark-blue);
        }
        
        .forgot-link:hover::after {
            width: 100%;
        }
        
        .back-btn {
            color: white;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            margin-bottom: 25px;
            position: relative;
            z-index: 2;
            background: rgba(255,255,255,0.1);
            padding: 12px 20px;
            border-radius: 50px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
        }
        
        .back-btn:hover {
            color: white;
            background: rgba(255,255,255,0.2);
            transform: translateX(-5px);
        }
        
        .alert {
            border-radius: 15px;
            border: none;
            padding: 18px 20px;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }
        
        .alert::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 5px;
            background: currentColor;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, #ffeaea 0%, #ffcccc 100%);
            color: #e74c3c;
        }
        
        .social-auth {
            margin-top: 30px;
            text-align: center;
        }
        
        .social-divider {
            display: flex;
            align-items: center;
            margin: 25px 0;
            color: #6c757d;
            font-weight: 500;
        }
        
        .social-divider::before,
        .social-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #dee2e6;
            margin: 0 15px;
        }
        
        .social-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
        }
        
        .social-btn {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.3rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .social-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
        
        .social-google { background: #db4437; }
        .social-facebook { background: #4267B2; }
        .social-twitter { background: #1DA1F2; }
        
        @media (max-width: 576px) {
            .auth-container {
                margin: 0 15px;
            }
            
            .tab-content {
                padding: 30px 25px;
            }
            
            .auth-header {
                padding: 30px 25px;
            }
            
            .nav-link {
                padding: 20px;
                font-size: 1rem;
            }
            
            .social-buttons {
                gap: 10px;
            }
            
            .social-btn {
                width: 50px;
                height: 50px;
                font-size: 1.2rem;
            }
        }
        
        .fade-in {
            animation: fadeIn 0.6s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <!-- Кнопка назад -->
                <a href="/" class="back-btn">
                    <i class="fas fa-arrow-left me-2"></i>Вернуться на главную
                </a>

                <!-- Основной контейнер -->
                <div class="auth-container fade-in">
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
                                <i class="fas fa-sign-in-alt me-2"></i>Вход
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
                            <form method="POST" action="authorization/auth">
                                @csrf
                                <div class="form-group">
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

                                <div class="form-group">
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

                            <!-- Социальная авторизация -->
                            <div class="social-auth">
                                <div class="social-divider">Или войдите через</div>
                                <div class="social-buttons">
                                    <a href="#" class="social-btn social-google">
                                        <i class="fab fa-google"></i>
                                    </a>
                                    <a href="#" class="social-btn social-facebook">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="#" class="social-btn social-twitter">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Регистрация -->
                        <div class="tab-pane fade" id="register">
                            <form method="POST" action="authorization/register">
                                @csrf
                                <div class="form-group">
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

                                <div class="form-group">
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

                                <div class="form-group">
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

                                <div class="form-group">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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

        // Анимация появления элементов
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.form-group, .btn-auth');
            elements.forEach((el, index) => {
                el.style.animationDelay = `${index * 0.1}s`;
                el.classList.add('fade-in');
            });
        });
    </script>
</body>
</html>