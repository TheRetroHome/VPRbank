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
                <h2 class="fw-bold text-gradient">Создание нового поста</h2>
                <p class="text-muted">Поделитесь своими мыслями и идеями с сообществом</p>
            </div>

            <!-- Форма создания поста -->
            <div class="card shadow-lg">
                <div class="card-header bg-gradient-primary text-white py-4">
                    <h4 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Новая публикация</h4>
                </div>
                <div class="card-body p-5">
                    <form action="/posts/store" method="POST">
                        @csrf
                        <!-- Поле заголовка -->
                        <div class="mb-4">
                            <label for="title" class="form-label fw-bold">
                                <i class="fas fa-heading me-2 text-primary"></i>Заголовок поста
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title') }}" 
                                   placeholder="Введите заголовок вашего поста" 
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Придумайте завлекающий заголовок, который привлечёт внимание</div>
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
                                      required>{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Минимальная длина - 100 символов. Будьте интересны!</div>
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
                                    <option value="{{ $tag->id }}" {{ old('tag_id') == $tag->id ? 'selected' : '' }}>
                                        {{ $tag->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tag_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Тег поможет пользователям быстрее найти ваш пост</div>
                        </div>

                        <!-- Переключатель активности -->
                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="is_active" 
                                       name="is_active" 
                                       value="1" 
                                       {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="is_active">
                                    <i class="fas fa-eye me-2 text-success"></i>Опубликовать сразу
                                </label>
                            </div>
                            <div class="form-text">Если выключено, пост будет сохранён как черновик</div>
                        </div>

                        <!-- Кнопки действия -->
                        <div class="d-grid gap-3 d-md-flex justify-content-md-end mt-5">
                            <a href="/" class="btn btn-outline-secondary btn-lg">
                                <i class="fas fa-times me-2"></i>Отмена
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg px-5">
                                <i class="fas fa-paper-plane me-2"></i>Опубликовать
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Подсказки -->
            <div class="card shadow-sm mt-4">
                <div class="card-header bg-gradient-info text-white">
                    <h5 class="mb-0"><i class="fas fa-lightbulb me-2"></i>Советы по написанию</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex mb-3">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-check-circle text-success fs-4"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fw-bold">Будьте конкретны</h6>
                                    <p class="text-muted mb-0">Чётко формулируйте основную мысль</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex mb-3">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-check-circle text-success fs-4"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fw-bold">Используйте форматирование</h6>
                                    <p class="text-muted mb-0">Разделяйте текст на абзацы</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex mb-3">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-check-circle text-success fs-4"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fw-bold">Проверяйте орфографию</h6>
                                    <p class="text-muted mb-0">Ошибки отвлекают читателей</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex mb-3">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-check-circle text-success fs-4"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fw-bold">Добавляйте примеры</h6>
                                    <p class="text-muted mb-0">Примеры делают текст понятнее</p>
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
.icon-create {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
}

.text-gradient {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
}

.bg-gradient-info {
    background: linear-gradient(135deg, #17a2b8 0%, #138496 100%) !important;
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
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.form-control-lg {
    font-size: 1.1rem;
    padding: 15px 20px;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 12px;
    padding: 15px 30px;
    font-weight: 600;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
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

/* Анимации */
.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
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