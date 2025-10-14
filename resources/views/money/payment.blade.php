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
                        <i class="fas fa-credit-card me-2"></i>Оплата услуг
                    </h2>
                    <p class="text-muted mb-0">Быстрая оплата популярных сервисов</p>
                </div>
                <div class="balance-badge">
                    <span class="badge bg-success fs-6">
                        <i class="fas fa-wallet me-1"></i>Баланс: {{ Auth::user()->cash ?? 0 }} ₽
                    </span>
                </div>
            </div>

            <!-- Карточка оплаты -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="card shadow-lg border-0 rounded-4">
                        <div class="card-header bg-gradient-primary text-white rounded-top-4 py-3">
                            <h5 class="mb-0 fw-bold">
                                <i class="fas fa-bolt me-2"></i>Быстрая оплата
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{ route('money.payment.process') }}" method="POST">
                                @csrf
                                
                                <!-- Выбор услуги -->
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Тип услуги</label>
                                    <div class="row g-3">
                                        <div class="col-6 col-md-4">
                                            <input type="radio" class="btn-check" name="service_type" value="steam" id="steam" checked>
                                            <label class="btn btn-outline-primary w-100 h-100 service-card" for="steam">
                                                <i class="fab fa-steam fa-2x mb-2"></i>
                                                <div>Steam</div>
                                            </label>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <input type="radio" class="btn-check" name="service_type" value="mobile" id="mobile">
                                            <label class="btn btn-outline-primary w-100 h-100 service-card" for="mobile">
                                                <i class="fas fa-mobile-alt fa-2x mb-2"></i>
                                                <div>Мобильная связь</div>
                                            </label>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <input type="radio" class="btn-check" name="service_type" value="internet" id="internet">
                                            <label class="btn btn-outline-primary w-100 h-100 service-card" for="internet">
                                                <i class="fas fa-wifi fa-2x mb-2"></i>
                                                <div>Интернет</div>
                                            </label>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <input type="radio" class="btn-check" name="service_type" value="food_delivery" id="food_delivery">
                                            <label class="btn btn-outline-primary w-100 h-100 service-card" for="food_delivery">
                                                <i class="fas fa-utensils fa-2x mb-2"></i>
                                                <div>Доставка еды</div>
                                            </label>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <input type="radio" class="btn-check" name="service_type" value="utilities" id="utilities">
                                            <label class="btn btn-outline-primary w-100 h-100 service-card" for="utilities">
                                                <i class="fas fa-home fa-2x mb-2"></i>
                                                <div>Коммунальные услуги</div>
                                            </label>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <input type="radio" class="btn-check" name="service_type" value="transport" id="transport">
                                            <label class="btn btn-outline-primary w-100 h-100 service-card" for="transport">
                                                <i class="fas fa-bus fa-2x mb-2"></i>
                                                <div>Транспорт</div>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Номер счета/телефона -->
                                <div class="mb-3">
                                    <label class="form-label fw-bold" id="accountLabel">Номер Steam аккаунта</label>
                                    <input type="text" name="account" class="form-control form-control-lg" 
                                           placeholder="Введите номер счета" required>
                                </div>

                                <!-- Сумма оплаты -->
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Сумма оплаты</label>
                                    <div class="input-group input-group-lg">
                                        <input type="number" name="amount" class="form-control" 
                                               placeholder="Введите сумму" min="1" max="100000" required>
                                        <span class="input-group-text">₽</span>
                                    </div>
                                    <div class="form-text">Минимум 1 рубль, максимум 100 000 рублей</div>
                                </div>

                                <!-- Описание -->
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Описание платежа (необязательно)</label>
                                    <textarea name="description" class="form-control" rows="2" 
                                              placeholder="Дополнительная информация о платеже"></textarea>
                                </div>

                                <!-- Кнопка оплаты -->
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-paper-plane me-2"></i>Оплатить
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Блок информации -->
                <div class="col-lg-4">
                    <div class="card shadow-lg border-0 rounded-4">
                        <div class="card-header bg-gradient-info text-white rounded-top-4 py-3">
                            <h5 class="mb-0 fw-bold">
                                <i class="fas fa-info-circle me-2"></i>Информация
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-shield-alt text-success fa-2x me-3"></i>
                                <div>
                                    <h6 class="fw-bold mb-0">Безопасно</h6>
                                    <small class="text-muted">Все платежи защищены</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-bolt text-warning fa-2x me-3"></i>
                                <div>
                                    <h6 class="fw-bold mb-0">Мгновенно</h6>
                                    <small class="text-muted">Платежи проходят за секунды</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-headset text-primary fa-2x me-3"></i>
                                <div>
                                    <h6 class="fw-bold mb-0">Поддержка 24/7</h6>
                                    <small class="text-muted">Всегда готовы помочь</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Быстрые суммы -->
                    <div class="card shadow-lg border-0 rounded-4 mt-4">
                        <div class="card-header bg-gradient-secondary text-white rounded-top-4 py-3">
                            <h5 class="mb-0 fw-bold">
                                <i class="fas fa-bolt me-2"></i>Быстрые суммы
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-4">
                                    <button type="button" class="btn btn-outline-primary w-100 quick-amount" data-amount="100">100 ₽</button>
                                </div>
                                <div class="col-4">
                                    <button type="button" class="btn btn-outline-primary w-100 quick-amount" data-amount="500">500 ₽</button>
                                </div>
                                <div class="col-4">
                                    <button type="button" class="btn btn-outline-primary w-100 quick-amount" data-amount="1000">1000 ₽</button>
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

.bg-gradient-secondary {
    background: linear-gradient(135deg, #6c757d 0%, #495057 100%) !important;
}

.service-card {
    padding: 1.5rem 0.5rem !important;
    border: 2px solid #dee2e6 !important;
    border-radius: 15px !important;
    transition: all 0.3s ease;
}

.service-card:hover {
    transform: translateY(-3px);
    border-color: #667eea !important;
}

.btn-check:checked + .service-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
    color: white !important;
    border-color: #667eea !important;
}

.quick-amount {
    transition: all 0.3s ease;
}

.quick-amount:hover {
    transform: scale(1.05);
}

.balance-badge .badge {
    font-size: 1rem;
    padding: 0.75rem 1rem;
}

.form-control-lg {
    border-radius: 12px;
    padding: 1rem 1.5rem;
    font-size: 1.1rem;
}

.input-group-lg .input-group-text {
    border-radius: 0 12px 12px 0;
    background: #f8f9fa;
    font-weight: 600;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Динамическое изменение label для счета
    const accountLabels = {
        'steam': 'Номер Steam аккаунта',
        'mobile': 'Номер телефона',
        'internet': 'Номер лицевого счета',
        'food_delivery': 'Номер заказа или телефон',
        'utilities': 'Номер лицевого счета',
        'entertainment': 'Номер аккаунта',
        'transport': 'Номер карты/телефона'
    };

    const accountInput = document.querySelector('input[name="account"]');
    const accountLabel = document.getElementById('accountLabel');

    document.querySelectorAll('input[name="service_type"]').forEach(radio => {
        radio.addEventListener('change', function() {
            accountLabel.textContent = accountLabels[this.value];
            accountInput.placeholder = `Введите ${accountLabels[this.value].toLowerCase()}`;
        });
    });

    // Быстрые суммы
    document.querySelectorAll('.quick-amount').forEach(button => {
        button.addEventListener('click', function() {
            document.querySelector('input[name="amount"]').value = this.getAttribute('data-amount');
        });
    });

    // Валидация суммы
    document.querySelector('input[name="amount"]').addEventListener('input', function() {
        const balance = {{ Auth::user()->cash ?? 0 }};
        if (parseFloat(this.value) > balance) {
            this.classList.add('is-invalid');
        } else {
            this.classList.remove('is-invalid');
        }
    });
});
</script>
@endsection