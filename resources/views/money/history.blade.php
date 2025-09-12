@extends('layouts.layout')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <!-- Заголовок -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="fw-bold text-gradient">
                    <i class="fas fa-history me-3"></i>История операций
                </h1>
                <div class="d-flex gap-2">
                    <a href="/" class="btn btn-primary rounded-pill">
                        <i class="fas fa-arrow-left me-2"></i>На главную
                    </a>
                    <a href="/money/money" class="btn btn-success rounded-pill">
                        <i class="fas fa-plus me-2"></i>Пополнить
                    </a>
                </div>
            </div>

            <!-- Карточка с балансом -->
            <div class="card shadow-lg border-0 rounded-4 mb-4 bg-gradient-blue">
                <div class="card-body text-center text-white py-4">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <i class="fas fa-wallet fa-4x mb-3"></i>
                            <h4 class="fw-bold">Текущий баланс</h4>
                        </div>
                        <div class="col-md-4">
                            <h2 class="display-4 fw-bold">{{ Auth::user()->cash ?? 0 }} ₽</h2>
                        </div>
                        <div class="col-md-4">
                            <div class="d-grid gap-2">
                                <a href="/money/money" class="btn btn-light btn-lg rounded-pill">
                                    <i class="fas fa-plus me-2"></i>Пополнить счёт
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Фильтры и статистика -->
            <div class="card shadow-lg border-0 rounded-4 mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h5 class="fw-bold mb-3"><i class="fas fa-filter me-2 text-primary"></i>Фильтры</h5>
                            <div class="d-flex flex-wrap gap-2">
                                <button class="btn btn-outline-primary rounded-pill active">Все операции</button>
                                <button class="btn btn-outline-success rounded-pill">Пополнения</button>
                                <button class="btn btn-outline-warning rounded-pill">Списания</button>
                                <button class="btn btn-outline-info rounded-pill">Переводы</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5 class="fw-bold mb-3"><i class="fas fa-chart-line me-2 text-success"></i>Статистика</h5>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Всего операций:</span>
                                <span class="fw-bold">{{ $transactions->total() }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">На странице:</span>
                                <span class="fw-bold">{{ $transactions->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Список операций -->
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-gradient-dark text-white rounded-top-4 py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-list me-2"></i>Последние операции
                    </h5>
                </div>
                <div class="card-body p-0">
                    @if($transactions->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">Дата</th>
                                        <th>Тип операции</th>
                                        <th>Описание</th>
                                        <th>Сумма</th>
                                        <th>Статус</th>
                                        <th class="text-center">Действия</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transactions as $transaction)
                                    <tr class="transaction-item">
                                        <td class="ps-4">
                                            <div class="d-flex flex-column">
                                                <span class="fw-bold">{{ $transaction->created_at->format('d.m.Y') }}</span>
                                                <small class="text-muted">{{ $transaction->created_at->format('H:i') }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ match($transaction->type) {
                                                'deposit' => 'success',
                                                'withdrawal' => 'warning',
                                                'transfer' => 'info',
                                                default => 'secondary'
                                            } }} rounded-pill py-2 px-3">
                                                <i class="fas fa-{{ match($transaction->type) {
                                                    'deposit' => 'arrow-down',
                                                    'withdrawal' => 'arrow-up',
                                                    'transfer' => 'exchange-alt',
                                                    default => 'question'
                                                } }} me-1"></i>
                                                {{ match($transaction->type) {
                                                    'deposit' => 'Пополнение',
                                                    'withdrawal' => 'Списание',
                                                    'transfer' => 'Перевод',
                                                    default => $transaction->type
                                                } }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="fw-medium">{{ $transaction->description }}</span>
                                        </td>
                                        <td>
                                            <span class="fw-bold text-{{ $transaction->type === 'deposit' ? 'success' : 'danger' }}">
                                                {{ $transaction->type === 'deposit' ? '+' : '-' }}{{ number_format($transaction->amount, 2) }} ₽
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ match($transaction->status) {
                                                'completed' => 'success',
                                                'pending' => 'warning',
                                                'failed' => 'danger',
                                                default => 'secondary'
                                            } }} rounded-pill">
                                                {{ match($transaction->status) {
                                                    'completed' => 'Завершено',
                                                    'pending' => 'В обработке',
                                                    'failed' => 'Ошибка',
                                                    default => $transaction->status
                                                } }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-primary rounded-pill" 
                                                    data-bs-toggle="tooltip" 
                                                    title="Детали операции">
                                                <i class="fas fa-info-circle"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <!-- Пустое состояние -->
                        <div class="text-center py-5">
                            <i class="fas fa-receipt fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted mb-3">Операций пока нет</h5>
                            <p class="text-muted mb-4">Здесь будет отображаться история ваших финансовых операций</p>
                            <a href="/money/money" class="btn btn-primary rounded-pill">
                                <i class="fas fa-plus me-2"></i>Совершить первую операцию
                            </a>
                        </div>
                    @endif
                </div>
                
                <!-- Пагинация -->
                @if($transactions->hasPages())
                <div class="card-footer bg-light rounded-bottom-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted">
                            Показано с {{ $transactions->firstItem() }} по {{ $transactions->lastItem() }} из {{ $transactions->total() }} записей
                        </div>
                        <nav>
                            {{ $transactions->links() }}
                        </nav>
                    </div>
                </div>
                @endif
            </div>

            <!-- Быстрые действия -->
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card shadow-lg border-0 rounded-4 text-center h-100">
                        <div class="card-body">
                            <i class="fas fa-download fa-3x text-success mb-3"></i>
                            <h5 class="fw-bold">Выписка</h5>
                            <p class="text-muted">Скачайте полную историю операций</p>
                            <button class="btn btn-outline-success rounded-pill w-100">
                                <i class="fas fa-file-export me-2"></i>Экспорт
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-lg border-0 rounded-4 text-center h-100">
                        <div class="card-body">
                            <i class="fas fa-search fa-3x text-primary mb-3"></i>
                            <h5 class="fw-bold">Поиск</h5>
                            <p class="text-muted">Найдите нужную операцию</p>
                            <div class="input-group">
                                <input type="text" class="form-control rounded-pill" placeholder="Поиск...">
                                <button class="btn btn-primary rounded-pill">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-lg border-0 rounded-4 text-center h-100">
                        <div class="card-body">
                            <i class="fas fa-question-circle fa-3x text-info mb-3"></i>
                            <h5 class="fw-bold">Помощь</h5>
                            <p class="text-muted">Нужна помощь с операциями?</p>
                            <button class="btn btn-outline-info rounded-pill w-100">
                                <i class="fas fa-life-ring me-2"></i>Поддержка
                            </button>
                        </div>
                    </div>
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

.bg-gradient-blue {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.bg-gradient-dark {
    background: linear-gradient(135deg, #343a40 0%, #23272b 100%);
}

.transaction-item {
    transition: all 0.3s ease;
}

.transaction-item:hover {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    transform: translateX(5px);
}

.rounded-4 {
    border-radius: 1rem !important;
}

.rounded-top-4 {
    border-top-left-radius: 1rem !important;
    border-top-right-radius: 1rem !important;
}

.rounded-bottom-4 {
    border-bottom-left-radius: 1rem !important;
    border-bottom-right-radius: 1rem !important;
}

.table th {
    border-top: none;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.85rem;
    color: #6c757d;
}

.table td {
    vertical-align: middle;
    padding: 1.25rem 0.75rem;
}

.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Инициализация tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Фильтрация операций
    const filterButtons = document.querySelectorAll('.btn-outline-primary, .btn-outline-success, .btn-outline-warning, .btn-outline-info');
    filterButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            filterButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            // Здесь будет логика фильтрации
        });
    });
});
</script>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection