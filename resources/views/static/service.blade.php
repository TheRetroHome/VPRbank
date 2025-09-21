@extends('layouts.layout')

@section('content')
<div class="container py-5">
    <!-- Герой-секция -->
    <div class="row align-items-center mb-6">
        <div class="col-lg-6">
            <h1 class="display-4 fw-bold text-gradient mb-4">Банковские услуги</h1>
            <p class="lead text-muted mb-4">ВПР Банк предлагает полный спектр финансовых услуг для вашего комфорта и prosperity</p>
            <div class="d-flex flex-wrap gap-3">
                <span class="badge bg-primary fs-6 p-3"><i class="fas fa-shield-alt me-2"></i>Надёжно</span>
                <span class="badge bg-success fs-6 p-3"><i class="fas fa-bolt me-2"></i>Быстро</span>
                <span class="badge bg-info fs-6 p-3"><i class="fas fa-percent me-2"></i>Выгодно</span>
            </div>
        </div>
        <div class="col-lg-6 text-center">
            <div class="hero-icon">
                <i class="fas fa-hand-holding-usd"></i>
            </div>
        </div>
    </div>

    <!-- Основные услуги -->
    <div class="row mb-6">
        <div class="col-12 text-center mb-5">
            <h2 class="fw-bold">Наши основные услуги</h2>
            <p class="text-muted">Выберите то, что подходит именно вам</p>
        </div>

        <!-- Карточка 1 -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card service-card h-100">
                <div class="card-icon">
                    <i class="fas fa-credit-card"></i>
                </div>
                <div class="card-body text-center">
                    <h4 class="fw-bold">Кредитные карты</h4>
                    <p class="text-muted">Кредитные карты с льготным периодом до 120 дней и кэшбэком до 10%</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success me-2"></i>Льготный период 120 дней</li>
                        <li><i class="fas fa-check text-success me-2"></i>Кэшбек до 10%</li>
                        <li><i class="fas fa-check text-success me-2"></i>Бесплатное обслуживание</li>
                    </ul>
                    <a href="#" class="btn btn-outline-primary mt-3">Подробнее</a>
                </div>
            </div>
        </div>

        <!-- Карточка 2 -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card service-card h-100">
                <div class="card-icon">
                    <i class="fas fa-home"></i>
                </div>
                <div class="card-body text-center">
                    <h4 class="fw-bold">Ипотека</h4>
                    <p class="text-muted">Ипотечные кредиты от 5.5% годовых на покупку жилья</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success me-2"></i>От 5.5% годовых</li>
                        <li><i class="fas fa-check text-success me-2"></i>Срок до 30 лет</li>
                        <li><i class="fas fa-check text-success me-2"></i>Первоначальный взнос от 15%</li>
                    </ul>
                    <a href="#" class="btn btn-outline-primary mt-3">Подробнее</a>
                </div>
            </div>
        </div>

        <!-- Карточка 3 -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card service-card h-100">
                <div class="card-icon">
                    <i class="fas fa-car"></i>
                </div>
                <div class="card-body text-center">
                    <h4 class="fw-bold">Автокредиты</h4>
                    <p class="text-muted">Выгодные условия кредитования на покупку нового и подержанного авто</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success me-2"></i>Ставка от 6.9% годовых</li>
                        <li><i class="fas fa-check text-success me-2"></i>Без первоначального взноса</li>
                        <li><i class="fas fa-check text-success me-2"></i>Срок кредита до 7 лет</li>
                    </ul>
                    <a href="#" class="btn btn-outline-primary mt-3">Подробнее</a>
                </div>
            </div>
        </div>

        <!-- Карточка 4 -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card service-card h-100">
                <div class="card-icon">
                    <i class="fas fa-piggy-bank"></i>
                </div>
                <div class="card-body text-center">
                    <h4 class="fw-bold">Вклады</h4>
                    <p class="text-muted">Накопительные счета и вклады с повышенной процентной ставкой</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success me-2"></i>До 8% годовых</li>
                        <li><i class="fas fa-check text-success me-2"></i>Ежемесячная капитализация</li>
                        <li><i class="fas fa-check text-success me-2"></i>Страхование вкладов</li>
                    </ul>
                    <a href="#" class="btn btn-outline-primary mt-3">Подробнее</a>
                </div>
            </div>
        </div>

        <!-- Карточка 5 -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card service-card h-100">
                <div class="card-icon">
                    <i class="fas fa-university"></i>
                </div>
                <div class="card-body text-center">
                    <h4 class="fw-bold">Инвестиции</h4>
                    <p class="text-muted">Инвестиционные продукты и консультации от профессиональных аналитиков</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success me-2"></i>ПИФы и ETF</li>
                        <li><i class="fas fa-check text-success me-2"></i>Акции и облигации</li>
                        <li><i class="fas fa-check text-success me-2"></i>Индивидуальные портфели</li>
                    </ul>
                    <a href="#" class="btn btn-outline-primary mt-3">Подробнее</a>
                </div>
            </div>
        </div>

        <!-- Карточка 6 -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card service-card h-100">
                <div class="card-icon">
                    <i class="fas fa-globe"></i>
                </div>
                <div class="card-body text-center">
                    <h4 class="fw-bold">Страхование</h4>
                    <p class="text-muted">Полис страхования жизни, имущества и путешествий</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success me-2"></i>Страхование жизни</li>
                        <li><i class="fas fa-check text-success me-2"></i>Имущественное страхование</li>
                        <li><i class="fas fa-check text-success me-2"></i>Страхование путешествий</li>
                    </ul>
                    <a href="#" class="btn btn-outline-primary mt-3">Подробнее</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Преимущества -->
    <div class="row bg-gradient-light rounded-4 p-5 mb-6">
        <div class="col-12 text-center mb-5">
            <h2 class="fw-bold">Почему выбирают нас?</h2>
        </div>
        <div class="col-md-4 text-center mb-4">
            <div class="feature-icon mb-3">
                <i class="fas fa-lock"></i>
            </div>
            <h5>100% безопасность</h5>
            <p class="text-muted">Все операции защищены современными технологиями шифрования</p>
        </div>
        <div class="col-md-4 text-center mb-4">
            <div class="feature-icon mb-3">
                <i class="fas fa-clock"></i>
            </div>
            <h5>Круглосуточная поддержка</h5>
            <p class="text-muted">Наша служба поддержки работает 24/7 для вашего удобства</p>
        </div>
        <div class="col-md-4 text-center mb-4">
            <div class="feature-icon mb-3">
                <i class="fas fa-mobile-alt"></i>
            </div>
            <h5>Мобильное приложение</h5>
            <p class="text-muted">Управляйте финансами с любого устройства в любое время</p>
        </div>
    </div>

    <!-- CTA секция -->
    <div class="row bg-primary rounded-4 p-5 text-white">
        <div class="col-lg-8">
            <h3 class="fw-bold mb-3">Готовы начать?</h3>
            <p class="mb-4">Откройте счёт онлайн всего за 5 минут и получите бесплатную кредитную карту</p>
        </div>
        <div class="col-lg-4 text-lg-end">
            <a href="#" class="btn btn-light btn-lg px-5">Начать сейчас</a>
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

.hero-icon {
    font-size: 8rem;
    color: #667eea;
    opacity: 0.8;
}

.service-card {
    border: none;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    padding: 2rem 1.5rem;
}

.service-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.card-icon {
    width: 80px;
    height: 80px;
    margin: -60px auto 1.5rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
}

.feature-icon {
    width: 70px;
    height: 70px;
    margin: 0 auto;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.bg-gradient-light {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.mb-6 {
    margin-bottom: 5rem !important;
}

.btn {
    border-radius: 15px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-outline-primary {
    border-width: 2px;
}

.btn:hover {
    transform: translateY(-2px);
}

.list-unstyled li {
    margin-bottom: 0.5rem;
}

/* Адаптивность */
@media (max-width: 768px) {
    .display-4 {
        font-size: 2.5rem;
    }
    
    .hero-icon {
        font-size: 5rem;
    }
    
    .service-card {
        margin-top: 3rem;
    }
    
    .card-icon {
        margin-top: -50px;
    }
}
</style>
@endsection