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
                            <a href="{{ route('user.profile') }}" class="text-decoration-none text-dark d-flex align-items-center">
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
                        <li class="list-group-item border-0 py-3 hover-item active">
                            <a href="{{ route('messages.index') }}" class="text-decoration-none text-dark d-flex align-items-center">
                                <i class="fas fa-envelope me-3 text-info"></i>
                                <span class="fw-medium">Сообщения</span>
                            </a>
                        </li>
                        @if(Auth::check() && Auth::user()->is_admin)
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
                        @endif
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

        <!-- Основной контент -->
        <div class="col-md-9">
            <!-- Заголовок переписки -->
            <div class="card shadow-lg border-0 rounded-4 mb-4">
                <div class="card-header bg-gradient-primary text-white rounded-top-4 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="avatar-circle me-3">
                                {{ strtoupper(substr($otherUser->name, 0, 1)) }}
                            </div>
                            <div>
                                <h5 class="mb-0 fw-bold">{{ $otherUser->name }}</h5>
                                <small class="opacity-75">
                                    @if($otherUser->is_admin)
                                    <span class="badge bg-success me-1">ADMIN</span>
                                    @endif
                                    {{ $otherUser->email }}
                                </small>
                            </div>
                        </div>
                        <a href="{{ route('messages.index') }}" class="btn btn-outline-light btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>Назад
                        </a>
                    </div>
                </div>
            </div>

            <!-- Область сообщений -->
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body messages-container" style="height: 500px; overflow-y: auto;">
                    @forelse($messages as $message)
                        <div class="message-item mb-3 {{ $message->sender_id === Auth::id() ? 'message-sent' : 'message-received' }}">
                            <div class="d-flex {{ $message->sender_id === Auth::id() ? 'justify-content-end' : 'justify-content-start' }}">
                                <div class="message-bubble {{ $message->sender_id === Auth::id() ? 'bg-primary text-white' : 'bg-light' }}">
                                    <div class="message-content">
                                        <p class="mb-1">{{ $message->content }}</p>
                                        <small class="{{ $message->sender_id === Auth::id() ? 'text-white-50' : 'text-muted' }}">
                                            {{ $message->created_at->format('H:i') }}
                                            @if($message->sender_id === Auth::id())
                                                @if($message->is_read)
                                                <i class="fas fa-check-double ms-1 text-success"></i>
                                                @else
                                                <i class="fas fa-check ms-1"></i>
                                                @endif
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Нет сообщений</h5>
                            <p class="text-muted">Начните общение с {{ $otherUser->name }}</p>
                        </div>
                    @endforelse
                </div>

                <!-- Форма отправки сообщения -->
                <div class="card-footer border-0 bg-transparent">
                    <form action="{{ route('messages.store') }}" method="POST" class="d-flex gap-2">
                        @csrf
                        <input type="hidden" name="recipient_id" value="{{ $otherUser->id }}">
                        <div class="flex-grow-1">
                            <input type="text" name="content" class="form-control" placeholder="Введите ваше сообщение..." required>
                        </div>
                        <button type="submit" class="btn btn-primary flex-shrink-0">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
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

.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
}

.bg-gradient-blue {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.avatar-circle {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 1.1rem;
}

.message-bubble {
    max-width: 70%;
    padding: 12px 16px;
    border-radius: 18px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    position: relative;
}

.message-sent .message-bubble {
    border-bottom-right-radius: 4px;
}

.message-received .message-bubble {
    border-bottom-left-radius: 4px;
}

.messages-container {
    scroll-behavior: smooth;
}

.messages-container::-webkit-scrollbar {
    width: 6px;
}

.messages-container::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.messages-container::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}

.messages-container::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
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

.rounded-4 {
    border-radius: 1rem !important;
}

.rounded-top-4 {
    border-top-left-radius: 1rem !important;
    border-top-right-radius: 1rem !important;
}

/* Анимации для сообщений */
.message-item {
    animation: fadeInUp 0.3s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.text-purple {
    color: #6f42c1 !important;
}
</style>

<script>
// Автопрокрутка к последнему сообщению
document.addEventListener('DOMContentLoaded', function() {
    const messagesContainer = document.querySelector('.messages-container');
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
    
    // Анимация появления сообщений
    const messages = document.querySelectorAll('.message-item');
    messages.forEach((message, index) => {
        message.style.animationDelay = `${index * 0.1}s`;
    });
});
</script>
@endsection