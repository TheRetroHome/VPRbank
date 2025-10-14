@auth
<!-- Сайдбар -->
<div class="col-md-3">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4 py-3">
            <h5 class="mb-0 fw-bold"><i class="fas fa-bars me-2"></i>Меню пользователя</h5>
        </div>
        <div class="card-body p-0">
            <ul class="list-group list-group-flush">
                <li class="list-group-item border-0 py-3 hover-item {{ request()->routeIs('user.profile') ? 'active' : '' }}">
                    <a href="/users/profile" class="text-decoration-none text-dark d-flex align-items-center">
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
                <li class="list-group-item border-0 py-3 hover-item {{ request()->routeIs('messages.*') ? 'active' : '' }}">
                    <a href="/messages/index" class="text-decoration-none text-dark d-flex align-items-center">
                        <i class="fas fa-envelope me-3 text-info"></i>
                        <span class="fw-medium">Сообщения</span>
                        @isset($unreadCount)
                            @if($unreadCount > 0)
                            <span class="badge bg-danger ms-auto">{{ $unreadCount }}</span>
                            @endif
                        @endisset
                    </a>
                </li>
                @if(Auth::check() && Auth::user()->is_admin)
                <li class="list-group-item border-0 py-3 hover-item {{ request()->routeIs('admin.*') ? 'active' : '' }}">
                    <a href="/admin/info" class="text-decoration-none text-dark d-flex align-items-center">
                        <i class="fas fa-shield-alt me-3 text-success"></i>
                        <span class="fw-medium">Панель управления</span>
                        <span class="badge bg-success ms-auto">ADMIN</span>
                    </a>
                </li>
                <li class="list-group-item border-0 py-3 hover-item {{ request()->routeIs('posts.create') ? 'active' : '' }}">
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
                <li class="list-group-item border-0 py-3 hover-item {{ request()->routeIs('money.history') ? 'active' : '' }}">
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
                <a href="/money/payment" class="btn btn-light btn-sm rounded-pill">
                    <i class="fas fa-plus me-1"></i>Оплатить
                </a>
            </div>
        </div>
    </div>
</div>
@endauth