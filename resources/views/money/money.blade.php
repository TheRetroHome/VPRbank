@extends('layouts.layout')
@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Карточка пополнения баланса -->
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-gradient-primary text-white rounded-top-4 py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-bold">
                            <i class="fas fa-wallet me-2"></i>Пополнение баланса
                        </h4>
                        <span class="badge bg-light text-primary fs-6">
                            <i class="fas fa-credit-card me-1"></i>Безопасно
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Информация о текущем балансе -->
                    <div class="alert alert-info rounded-4 border-0 mb-4">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-info-circle fa-2x text-info me-3"></i>
                            <div>
                                <h6 class="mb-1">Текущий баланс</h6>
                                <h4 class="mb-0 fw-bold text-dark">{{ Auth::user()->cash ?? 0 }} ₽</h4>
                            </div>
                        </div>
                    </div>

                    <!-- Форма пополнения -->
                    <form action="/money/addMoney" method="POST">
                        @csrf
                        <!-- Сумма пополнения -->
                        <div class="mb-4">
                            <label for="amount" class="form-label fw-bold text-dark">
                                <i class="fas fa-ruble-sign me-2 text-success"></i>Сумма пополнения
                            </label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light border-end-0 rounded-start-4">
                                    <i class="fas fa-money-bill-wave text-success"></i>
                                </span>
                                <input type="number" 
                                       class="form-control border-start-0 rounded-end-4 py-3" 
                                       id="amount" 
                                       name="amount" 
                                       placeholder="Введите сумму"
                                       min="10"
                                       max="100000"
                                       required>
                                <span class="input-group-text bg-light border-start-0 rounded-end-4">₽</span>
                            </div>
                            <div class="form-text">Минимальная сумма: 10 ₽</div>
                        </div>

                        <!-- Быстрый выбор суммы -->
                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark">
                                <i class="fas fa-bolt me-2 text-warning"></i>Быстрый выбор
                            </label>
                            <div class="d-flex gap-2 flex-wrap">
                                <button type="button" class="btn btn-outline-primary rounded-pill amount-btn" data-amount="100">
                                    100 ₽
                                </button>
                                <button type="button" class="btn btn-outline-primary rounded-pill amount-btn" data-amount="500">
                                    500 ₽
                                </button>
                                <button type="button" class="btn btn-outline-primary rounded-pill amount-btn" data-amount="1000">
                                    1 000 ₽
                                </button>
                                <button type="button" class="btn btn-outline-primary rounded-pill amount-btn" data-amount="5000">
                                    5 000 ₽
                                </button>
                            </div>
                        </div>

                        <!-- Способ оплаты -->
                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark">
                                <i class="fas fa-credit-card me-2 text-primary"></i>Способ оплаты
                            </label>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-check card-option">
                                        <input class="form-check-input" type="radio" name="payment_method" id="card" value="card" checked>
                                        <label class="form-check-label w-100 p-3 rounded-4 border" for="card">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-credit-card fa-2x text-primary me-3"></i>
                                                <div>
                                                    <h6 class="mb-1">Банковская карта</h6>
                                                    <small class="text-muted">Visa, Mastercard, Мир</small>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-check card-option">
                                        <input class="form-check-input" type="radio" name="payment_method" id="qiwi" value="qiwi">
                                        <label class="form-check-label w-100 p-3 rounded-4 border" for="qiwi">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-mobile-alt fa-2x text-warning me-3"></i>
                                                <div>
                                                    <h6 class="mb-1">QIWI Кошелек</h6>
                                                    <small class="text-muted">Мгновенное пополнение</small>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Кнопка оплаты -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill py-3 fw-bold">
                                <i class="fas fa-lock me-2"></i>Пополнить баланс
                            </button>
                        </div>
                    </form>

                    <!-- Информация о безопасности -->
                    <div class="alert alert-light rounded-4 border mt-4">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-shield-alt fa-2x text-success me-3"></i>
                            <div>
                                <h6 class="mb-1 text-success">Безопасность гарантирована</h6>
                                <small class="text-muted">Все операции защищены SSL-шифрованием</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card-option {
    transition: all 0.3s ease;
}

.card-option .form-check-input:checked + label {
    border-color: #007bff !important;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 123, 255, 0.1);
}

.amount-btn {
    transition: all 0.3s ease;
}

.amount-btn:hover {
    background-color: #007bff;
    color: white;
    transform: translateY(-2px);
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
}

.rounded-4 {
    border-radius: 1rem !important;
}

.rounded-top-4 {
    border-top-left-radius: 1rem !important;
    border-top-right-radius: 1rem !important;
}

.input-group-text {
    border-radius: 1rem !important;
}

.form-control {
    border-radius: 1rem !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Быстрый выбор суммы
    const amountBtns = document.querySelectorAll('.amount-btn');
    const amountInput = document.getElementById('amount');
    
    amountBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const amount = this.getAttribute('data-amount');
            amountInput.value = amount;
            
            // Подсветка выбранной кнопки
            amountBtns.forEach(b => b.classList.remove('btn-primary'));
            amountBtns.forEach(b => b.classList.add('btn-outline-primary'));
            this.classList.remove('btn-outline-primary');
            this.classList.add('btn-primary');
        });
    });

    // Валидация формы
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const amount = parseFloat(amountInput.value);
        if (amount < 10 || amount > 100000) {
            e.preventDefault();
            alert('Сумма должна быть от 10 до 100 000 ₽');
        }
    });
});
</script>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

@endsection