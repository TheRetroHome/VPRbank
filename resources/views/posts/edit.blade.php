@extends('layouts.layout')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <!-- Заголовок -->
            <div class="text-center mb-5">
                <div class="icon-create mx-auto mb-3">
                    <i class="fas fa-edit"></i>
                </div>
                <h2 class="fw-bold text-gradient">Редактирование поста</h2>
                <p class="text-muted">Внесите изменения в вашу публикацию</p>
            </div>

            <!-- Форма редактирования поста -->
            <div class="card shadow-lg">
                <div class="card-header bg-gradient-warning text-white py-4">
                    <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Редактирование публикации</h4>
                </div>
                <div class="card-body p-5">
                    <form action="{{ route('posts.update', $post->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <!-- Поле заголовка -->
                        <div class="mb-4">
                            <label for="title" class="form-label fw-bold">
                                <i class="fas fa-heading me-2 text-primary"></i>Заголовок поста
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title', $post->title) }}" 
                                   placeholder="Введите заголовок вашего поста" 
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Поле содержимого -->
                        <div class="mb-4">
                            <label for="content" class="form-label fw-bold">
                                <i class="fas fa-align-left me-2 text-primary"></i>Содержание поста
                            </label>
                            <textarea class="form-control @error('content') is-invalid @enderror" 
                                      id="content" 
                                      name="content" 
                                      rows="8" 
                                      placeholder="Напишите содержание вашего поста..." 
                                      required>{{ old('content', $post->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Минимальная длина - 100 символов</div>
                        </div>
                        
                        <!-- Выбор тега -->
                        <div class="mb-4">
                            <label for="tag_id" class="form-label fw-bold">
                                <i class="fas fa-tags me-2 text-primary"></i>Категория (тег)
                            </label>
                            <select class="form-select form-select-lg @error('tag_id') is-invalid @enderror" 
                                    id="tag_id" 
                                    name="tag_id">
                                <option value="">— Выберите тег —</option>
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}" {{ old('tag_id', $post->tag_id) == $tag->id ? 'selected' : '' }}>
                                        {{ $tag->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tag_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Переключатель активности -->
                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="is_active" 
                                       name="is_active" 
                                       value="1" 
                                       {{ old('is_active', $post->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="is_active">
                                    <i class="fas fa-eye me-2 text-success"></i>Опубликован
                                </label>
                            </div>
                            <div class="form-text">Если выключено, пост будет скрыт от пользователей</div>
                        </div>

                        <!-- Информация о посте -->
                        <div class="card bg-light border-0 mb-4">
                            <div class="card-body">
                                <h6 class="fw-bold text-muted mb-3">
                                    <i class="fas fa-info-circle me-2"></i>Информация о посте
                                </h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <small class="text-muted">
                                            <i class="fas fa-calendar me-1"></i>
                                            Создан: {{ $post->created_at->format('d.m.Y H:i') }}
                                        </small>
                                    </div>
                                    <div class="col-md-6">
                                        <small class="text-muted">
                                            <i class="fas fa-sync-alt me-1"></i>
                                            Обновлен: {{ $post->updated_at->format('d.m.Y H:i') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Кнопки действия -->
                        <div class="d-grid gap-3 d-md-flex justify-content-md-end mt-5">
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-outline-secondary btn-lg">
                                <i class="fas fa-times me-2"></i>Отмена
                            </a>
                            <button type="submit" class="btn btn-warning btn-lg px-5">
                                <i class="fas fa-save me-2"></i>Обновить пост
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Опасная зона -->
            <div class="card shadow-sm mt-4 border-danger">
                <div class="card-header bg-gradient-danger text-white">
                    <h5 class="mb-0"><i class="fas fa-exclamation-triangle me-2"></i>Опасная зона</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3">Удаление поста невозможно отменить. Все данные будут безвозвратно удалены.</p>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены, что хотите удалить этот пост?')">
                            <i class="fas fa-trash me-2"></i>Удалить пост
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.icon-create {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: linear-gradient(135deg, #f6ad55 0%, #ed8936 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    box-shadow: 0 10px 30px rgba(246, 173, 85, 0.3);
}

.text-gradient {
    background: linear-gradient(135deg, #f6ad55 0%, #ed8936 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.bg-gradient-warning {
    background: linear-gradient(135deg, #f6ad55 0%, #ed8936 100%) !important;
}

.bg-gradient-danger {
    background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%) !important;
}

.card {
    border: none;
    border-radius: 20px;
}

.card-header {
    border-radius: 20px 20px 0 0 !important;
    border: none;
}

.form-control {
    border-radius: 12px;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #f6ad55;
    box-shadow: 0 0 0 0.2rem rgba(246, 173, 85, 0.25);
}

.form-control-lg {
    font-size: 1.1rem;
    padding: 15px 20px;
}

.btn-warning {
    background: linear-gradient(135deg, #f6ad55 0%, #ed8936 100%);
    border: none;
    border-radius: 12px;
    padding: 15px 30px;
    font-weight: 600;
    color: white;
}

.btn-warning:hover {
    background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(246, 173, 85, 0.3);
    color: white;
}

.btn-outline-secondary {
    border-radius: 12px;
    padding: 15px 30px;
    font-weight: 600;
}

.form-check-input:checked {
    background-color: #28a745;
    border-color: #28a745;
}

.form-check-input {
    width: 3em;
    height: 1.5em;
}

.textarea-counter {
    font-size: 0.9rem;
    color: #6c757d;
}
</style>

<script>
// Подсчёт символов в текстовом поле
document.addEventListener('DOMContentLoaded', function() {
    const contentTextarea = document.getElementById('content');
    const counter = document.createElement('div');
    counter.className = 'textarea-counter text-end mt-2';
    contentTextarea.parentNode.appendChild(counter);

    function updateCounter() {
        const length = contentTextarea.value.length;
        counter.textContent = `${length} символов` + (length < 100 ? ' (минимум 100)' : '');
        
        if (length < 100) {
            counter.classList.add('text-danger');
            counter.classList.remove('text-success');
        } else {
            counter.classList.remove('text-danger');
            counter.classList.add('text-success');
        }
    }

    contentTextarea.addEventListener('input', updateCounter);
    updateCounter();
});
</script>
@endsection