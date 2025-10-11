@extends('layouts.layout')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Автоматически подключаем сайдбар -->
        @include('layouts.partials.sidebar')
        
        <!-- Основной контент -->
        <div class="@auth col-md-9 @else col-12 @endauth">
            <!-- Заголовок -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold text-gradient mb-1">
                        <i class="fas fa-comments me-2"></i>Мои сообщения
                    </h2>
                    <p class="text-muted mb-0">Общайтесь с другими пользователями</p>
                </div>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newMessageModal">
                    <i class="fas fa-plus me-2"></i>Новое сообщение
                </button>
            </div>

            <!-- Список диалогов -->
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-gradient-primary text-white rounded-top-4 py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-inbox me-2"></i>Диалоги
                        @if($conversations->where('is_read', false)->count() > 0)
                        <span class="badge bg-light text-primary ms-2">{{ $conversations->where('is_read', false)->count() }} новых</span>
                        @endif
                    </h5>
                </div>
                <div class="card-body p-0">
                    @forelse($conversations as $conversation)
                        @php
                            $otherUser = $conversation->sender_id === Auth::id() ? $conversation->recipient : $conversation->sender;
                            $lastMessage = $conversation;
                            $isUnread = !$lastMessage->is_read && $lastMessage->sender_id !== Auth::id();
                        @endphp
                        <div class="conversation-item p-3 border-bottom hover-item">
                            <div class="d-flex align-items-center">
                                <!-- Аватар пользователя -->
                                <div class="conversation-avatar me-3">
                                    <div class="avatar-circle">
                                        {{ strtoupper(substr($otherUser->name, 0, 1)) }}
                                    </div>
                                </div>
                                
                                <!-- Информация о диалоге -->
                                <div class="flex-grow-1 min-width-0">
                                    <div class="d-flex justify-content-between align-items-start mb-1">
                                        <h6 class="fw-bold mb-0 text-break {{ $isUnread ? 'text-dark' : 'text-muted' }}">
                                            {{ $otherUser->name }}
                                            @if($otherUser->is_admin)
                                            <span class="badge bg-success ms-1">ADMIN</span>
                                            @endif
                                        </h6>
                                        <small class="text-muted flex-shrink-0">
                                            {{ $lastMessage->created_at->format('H:i') }}
                                        </small>
                                    </div>
                                    <p class="mb-1 text-break {{ $isUnread ? 'fw-medium text-dark' : 'text-muted' }}">
                                        @if($lastMessage->sender_id === Auth::id())
                                            <i class="fas fa-reply me-1 text-info"></i>Вы: 
                                        @endif
                                        {{ Str::limit($lastMessage->content, 60) }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            {{ $lastMessage->created_at->format('d.m.Y') }}
                                        </small>
                                        @if($isUnread)
                                        <span class="badge bg-danger rounded-pill">Новое</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Ссылка на диалог -->
                            <a href="{{ route('messages.show', $otherUser->id) }}" class="stretched-link"></a>
                        </div>
                    @empty
                        <!-- Состояние пустого списка -->
                        <div class="text-center py-5">
                            <i class="fas fa-comments fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted mb-2">Нет сообщений</h5>
                            <p class="text-muted mb-4">Начните общение с другими пользователями</p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newMessageModal">
                                <i class="fas fa-plus me-2"></i>Написать сообщение
                            </button>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Модальное окно нового сообщения -->
<div class="modal fade" id="newMessageModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-edit me-2"></i>Новое сообщение
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('messages.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold">Получатель</label>
                        <select name="recipient_id" class="form-select" required>
                            <option value="">Выберите пользователя...</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Сообщение</label>
                        <textarea name="content" class="form-control" rows="4" placeholder="Введите ваше сообщение..." required></textarea>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane me-2"></i>Отправить
                        </button>
                    </div>
                </form>
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

.conversation-item {
    transition: all 0.3s ease;
    position: relative;
    border-left: 3px solid transparent;
}

.conversation-item:hover {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-left: 3px solid #007bff;
    transform: translateX(5px);
}

.conversation-item.active {
    background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
    border-left: 3px solid #2196f3;
}

.avatar-circle {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 1.2rem;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
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

.min-width-0 {
    min-width: 0;
}

.text-break {
    word-break: break-word;
}

/* Анимации */
.conversation-item {
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

.text-purple {
    color: #6f42c1 !important;
}
</style>

<script>
// Анимация появления диалогов
document.addEventListener('DOMContentLoaded', function() {
    const items = document.querySelectorAll('.conversation-item');
    items.forEach((item, index) => {
        item.style.animationDelay = `${index * 0.1}s`;
    });
});
</script>
@endsection