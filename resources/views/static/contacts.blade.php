@extends('layouts.layout')
@section('content')
<div class="container py-5">
    <!-- Заголовок -->
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold text-primary mb-3">
            <i class="fas fa-handshake me-3"></i>Наша команда
        </h1>
        <p class="lead text-muted">Профессионалы, которые делают ВПР Банк лучшим</p>
    </div>

   <!-- Основной контент -->
<div class="row justify-content-center">
    <!-- Глава банка -->
    <div class="col-lg-6 mb-5">
        <div class="card executive-card h-100 border-0 shadow-lg">
            <div class="card-header-executive">
                <div class="executive-image">
                    <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&h=500&q=80&crop=top&fit=crop&crop=faces,top" 
                         alt="Ищенко Егор Дмитриевич" class="img-fluid">
                    <div class="executive-overlay"></div>
                </div>
            </div>
            <div class="card-body text-center py-4">
                <h3 class="fw-bold mb-2">Ищенко Егор Дмитриевич</h3>
                <p class="text-primary fw-semibold mb-3">Председатель Правления</p>
                <p class="text-muted mb-4">
                    Опытный руководитель с 20-летним стажем в банковской сфере. 
                    Под его руководством ВПР Банк стал лидером в области инновационных финансовых решений.
                </p>
                <div class="executive-contacts">
                    <div class="contact-item">
                        <i class="fas fa-envelope text-primary me-2"></i>
                        <span>e.ishchenko@vpr-bank.ru</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone text-primary me-2"></i>
                        <span>+7 (800) 555-01-00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Зам главы -->
    <div class="col-lg-6 mb-5">
        <div class="card executive-card h-100 border-0 shadow-lg">
            <div class="card-header-executive">
                <div class="executive-image">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&h=500&q=80&crop=faces,top" 
                         alt="Ильин Владислав Александрович" class="img-fluid">
                    <div class="executive-overlay"></div>
                </div>
            </div>
            <div class="card-body text-center py-4">
                <h3 class="fw-bold mb-2">Ильин Владислав Александрович</h3>
                <p class="text-primary fw-semibold mb-3">Генеральный директор</p>
                <p class="text-muted mb-4">
                    Стратегический лидер и визионер в области финансовых технологий. 
                    Отвечает за цифровую трансформацию и развитие инновационных сервисов банка.
                </p>
                <div class="executive-contacts">
                    <div class="contact-item">
                        <i class="fas fa-envelope text-primary me-2"></i>
                        <span>v.ilin@vpr-bank.ru</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone text-primary me-2"></i>
                        <span>+7 (800) 555-01-01</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Контактная информация -->
    <div class="row mt-5">
        <div class="col-lg-8 mx-auto">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-primary text-white py-4">
                    <h4 class="mb-0">
                        <i class="fas fa-map-marker-alt me-2"></i>Контактная информация
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="contact-info-item mb-4">
                                <div class="contact-icon">
                                    <i class="fas fa-building text-primary fa-2x"></i>
                                </div>
                                <div class="contact-details">
                                    <h6 class="fw-bold">Главный офис</h6>
                                    <p class="text-muted mb-0">Москва, Пресненская наб., 12</p>
                                    <p class="text-muted">Москва-Сити, Башня "Федерация"</p>
                                </div>
                            </div>
                            
                            <div class="contact-info-item mb-4">
                                <div class="contact-icon">
                                    <i class="fas fa-clock text-primary fa-2x"></i>
                                </div>
                                <div class="contact-details">
                                    <h6 class="fw-bold">Часы работы</h6>
                                    <p class="text-muted mb-0">Пн-Пт: 9:00 - 18:00</p>
                                    <p class="text-muted">Сб-Вс: выходной</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="contact-info-item mb-4">
                                <div class="contact-icon">
                                    <i class="fas fa-phone text-primary fa-2x"></i>
                                </div>
                                <div class="contact-details">
                                    <h6 class="fw-bold">Телефоны</h6>
                                    <p class="text-muted mb-0">Горячая линия: 8-800-555-35-35</p>
                                    <p class="text-muted">Факс: +7 (495) 123-45-67</p>
                                </div>
                            </div>
                            
                            <div class="contact-info-item mb-4">
                                <div class="contact-icon">
                                    <i class="fas fa-envelope text-primary fa-2x"></i>
                                </div>
                                <div class="contact-details">
                                    <h6 class="fw-bold">Электронная почта</h6>
                                    <p class="text-muted mb-0">info@vpr-bank.ru</p>
                                    <p class="text-muted">support@vpr-bank.ru</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Дополнительная информация -->
    <div class="row mt-5">
        <div class="col-lg-10 mx-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-5">
                    <i class="fas fa-headset text-primary fa-4x mb-4"></i>
                    <h3 class="fw-bold mb-3">Всегда на связи</h3>
                    <p class="text-muted mb-4">
                        Наша команда готова ответить на все ваши вопросы и предоставить 
                        профессиональную консультацию по любым финансовым продуктам
                    </p>
                    <a href="tel:88005553535" class="btn btn-primary btn-lg px-5 py-3">
                        <i class="fas fa-phone me-2"></i>Позвонить сейчас
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.executive-card {
    border-radius: 20px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    overflow: hidden;
}

.executive-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15) !important;
}

.card-header-executive {
    position: relative;
    padding: 0;
    border: none;
}

.executive-image {
    position: relative;
    height: 300px;
    overflow: hidden;
}

.executive-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.executive-card:hover .executive-image img {
    transform: scale(1.05);
}

.executive-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(transparent 50%, rgba(0,0,0,0.7));
}

.contact-item {
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 10px 0;
    padding: 10px;
    background: #f8f9fa;
    border-radius: 10px;
    transition: background 0.3s ease;
}

.contact-item:hover {
    background: #e9ecef;
}

.contact-info-item {
    display: flex;
    align-items: flex-start;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 15px;
    transition: background 0.3s ease;
}

.contact-info-item:hover {
    background: #e9ecef;
}

.contact-icon {
    margin-right: 20px;
    min-width: 50px;
    text-align: center;
}

.contact-details h6 {
    color: #2c3e50;
    margin-bottom: 5px;
}

.btn-primary {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    border: none;
    border-radius: 15px;
    padding: 15px 30px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0,123,255,0.3);
}

.card {
    border-radius: 20px;
}

.card-header {
    border-radius: 20px 20px 0 0 !important;
}

@media (max-width: 768px) {
    .executive-image {
        height: 250px;
    }
    
    .contact-info-item {
        flex-direction: column;
        text-align: center;
    }
    
    .contact-icon {
        margin-right: 0;
        margin-bottom: 15px;
    }
}
</style>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

@endsection