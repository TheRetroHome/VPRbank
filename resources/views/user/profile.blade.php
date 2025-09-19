@extends('layouts.layout')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- Заголовок -->
            <div class="text-center mb-5">
                <div class="user-avatar-profile mx-auto mb-3">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <h2 class="fw-bold text-gradient">Профиль пользователя</h2>
                <p class="text-muted">Управление вашими персональными данными</p>
            </div>

            <div class="row">
                <!-- Левая колонка - Информация -->
                <div class="col-md-5 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-gradient-info text-white">
                            <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Личная информация</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4">
                                <div class="flex-shrink-0">
                                    <div class="avatar-lg">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h4 class="mb-1">{{ Auth::user()->name }}</h4>
                                    <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted"><i class="fas fa-wallet me-2"></i>Баланс</span>
                                    <span class="fw-bold text-success fs-5">{{ number_format(Auth::user()->cash, 0, ',', ' ') }} ₽</span>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted"><i class="fas fa-user-tag me-2"></i>Роль</span>
                                    <span class="badge bg-primary fs-6">{{ Auth::user()->role }}</span>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted"><i class="fas fa-shield-alt me-2"></i>Статус</span>
                                    <span class="badge {{ Auth::user()->status ? 'bg-success' : 'bg-danger' }} fs-6">
                                        {{ Auth::user()->status ? 'Активен' : 'Заблокирован' }}
                                    </span>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted"><i class="fas fa-calendar-alt me-2"></i>Дата регистрации</span>
                                    <span class="fw-bold">{{ Auth::user()->created_at->format('d.m.Y') }}</span>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted"><i class="fas fa-clock me-2"></i>В системе</span>
                                    <span class="fw-bold">{{ Auth::user()->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Правая колонка - Форма редактирования -->
                <div class="col-md-7">
                    <div class="card shadow-sm">
                        <div class="card-header bg-gradient-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Редактирование профиля</h5>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-4">
                                    <label for="name" class="form-label fw-bold">Имя пользователя</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                               id="name" name="name" value="{{ old('name', Auth::user()->name) }}" 
                                               placeholder="Введите ваше имя" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-text">Ваше отображаемое имя в системе</div>
                                </div>

                                <div class="mb-4">
                                    <label for="email" class="form-label fw-bold">Email адрес</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               id="email" name="email" value="{{ old('email', Auth::user()->email) }}" 
                                               placeholder="Введите ваш email" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-text">Используется для входа в систему</div>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-save me-2"></i>Сохранить изменения
                                    </button>
                                    <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-arrow-left me-2"></i>Вернуться на главную
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Статистика -->
                    <div class="card shadow-sm mt-4">
                        <div class="card-header bg-gradient-secondary text-white">
                            <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Статистика</h5>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-4">
                                    <div class="stat-number text-primary fs-3 fw-bold">{{ $user->transactions->count() }}</div>
                                    <div class="stat-label text-muted">Транзакций</div>
                                </div>
                                <div class="col-4">
                                    <div class="stat-number text-success fs-3 fw-bold">{{ $user->transactions->where('type','deposit')->count() }}</div>
                                    <div class="stat-label text-muted">Пополнений</div>
                                </div>
                                <div class="col-4">
                                    <div class="stat-number text-info fs-3 fw-bold">{{ abs(ceil(now()->diffInDays($user->created_at))) }}</div>
                                    <div class="stat-label text-muted">Дней в системе</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.user-avatar-profile {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 2rem;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.avatar-lg {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 1.5rem;
}

.text-gradient {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.bg-gradient-info {
    background: linear-gradient(135deg, #17a2b8 0%, #138496 100%) !important;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
}

.bg-gradient-secondary {
    background: linear-gradient(135deg, #6c757d 0%, #495057 100%) !important;
}

.info-item {
    padding: 12px 0;
    border-bottom: 1px solid #eee;
}

.info-item:last-child {
    border-bottom: none;
}

.stat-number {
    font-size: 2rem;
    font-weight: 800;
}

.stat-label {
    font-size: 0.9rem;
    margin-top: 5px;
}

.card {
    border: none;
    border-radius: 15px;
}

.card-header {
    border-radius: 15px 15px 0 0 !important;
    border: none;
}

.input-group-text {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 10px;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}
</style>
@endsection