<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель управления - ВПР Банк</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .admin-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            margin: 2rem auto;
            padding: 2rem;
            max-width: 1400px;
        }
        
        .admin-header {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            text-align: center;
        }
        
        .admin-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }
        
        .admin-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
        }
        
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 1.5rem;
            text-align: center;
            margin-bottom: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .stats-number {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }
        
        .stats-label {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        
        .table-container {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }
        
        .table-header {
            background: linear-gradient(135deg, #343a40 0%, #23272b 100%);
            color: white;
            padding: 1rem 1.5rem;
        }
        
        .table th {
            background: #495057;
            color: white;
            font-weight: 600;
            padding: 1rem;
            border: none;
        }
        
        .table td {
            padding: 1rem;
            vertical-align: middle;
            border-color: #e9ecef;
        }
        
        .table tr:hover {
            background: #f8f9fa;
            transition: background 0.3s ease;
        }
        
        .badge-admin {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
        }
        
        .badge-user {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
        }
        
        .btn-action {
            border-radius: 10px;
            padding: 0.5rem 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            margin: 0.2rem;
        }
        
        .btn-promote {
            background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
            color: white;
        }
        
        .btn-promote:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 193, 7, 0.3);
        }
        
        .btn-demote {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            color: white;
        }
        
        .btn-demote:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3);
        }
        
        .btn-delete {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
        }
        
        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
        }
        
        .btn-home {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-home:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
        }
        
        .alert-custom {
            border-radius: 15px;
            border: none;
            padding: 1rem 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #6c757d;
        }
        
        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }
        
        .action-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }
        
        @media (max-width: 768px) {
            .admin-container {
                margin: 1rem;
                padding: 1rem;
            }
            
            .admin-title {
                font-size: 2rem;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn-action {
                width: 100%;
                margin: 0.2rem 0;
            }
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="admin-container">
            <!-- Заголовок -->
            <div class="admin-header">
                <h1 class="admin-title">
                    <i class="fas fa-users-cog me-2"></i>Панель управления
                </h1>
                <p class="admin-subtitle">Управление пользователями системы ВПР Банк</p>
            </div>
            
            <!-- Статистика -->
            <div class="row">
                <div class="col-md-4">
                    <div class="stats-card">
                        <div class="stats-number">{{ $users->count() }}</div>
                        <div class="stats-label">Всего пользователей</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats-card">
                        <div class="stats-number">{{ $users->where('is_admin', true)->count() }}</div>
                        <div class="stats-label">Администраторов</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats-card">
                        <div class="stats-number">{{ $users->where('is_admin', false)->count() }}</div>
                        <div class="stats-label">Обычных пользователей</div>
                    </div>
                </div>
            </div>
            
            <!-- Сообщения -->
            @if(session('success'))
                <div class="alert alert-success alert-custom">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger alert-custom">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                </div>
            @endif
            
            <!-- Таблица пользователей -->
            @if($users->count() > 0)
                <div class="table-container">
                    <div class="table-header">
                        <h5 class="mb-0">
                            <i class="fas fa-list me-2"></i>Список пользователей
                        </h5>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-hashtag me-1"></i>ID</th>
                                    <th><i class="fas fa-user me-1"></i>Имя</th>
                                    <th><i class="fas fa-envelope me-1"></i>Email</th>
                                    <th><i class="fas fa-shield-alt me-1"></i>Статус</th>
                                    <th><i class="fas fa-calendar me-1"></i>Дата регистрации</th>
                                    <th><i class="fas fa-cogs me-1"></i>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td><strong>#{{ $user->id }}</strong></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="user-avatar me-2" style="width: 35px; height: 35px; background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); border-radius: 50%; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            {{ $user->name }}
                                        </div>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->is_admin)
                                            <span class="badge badge-admin">
                                                <i class="fas fa-crown me-1"></i>Админ
                                            </span>
                                        @else
                                            <span class="badge badge-user">
                                                <i class="fas fa-user me-1"></i>Пользователь
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at->format('d.m.Y H:i') }}</td>
                                    <td>
                                        <div class="action-buttons">
                                            @if($user->id !== Auth::id())
                                            <form action="{{ route('users.setAdmin', $user->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="is_admin" value="{{ $user->is_admin ? 0 : 1 }}">
                                                <button type="submit" class="btn btn-action {{ $user->is_admin ? 'btn-demote' : 'btn-promote' }}">
                                                    <i class="fas {{ $user->is_admin ? 'fa-user-slash' : 'fa-user-shield' }} me-1"></i>
                                                    {{ $user->is_admin ? 'Забрать права' : 'Сделать админом' }}
                                                </button>
                                            </form>
                                            
                                            <form action="{{ route('users.delete', $user->id) }}" method="POST" 
                                                  onsubmit="return confirm('Вы уверены, что хотите удалить этого пользователя?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-action btn-delete">
                                                    <i class="fas fa-trash me-1"></i>Удалить
                                                </button>
                                            </form>
                                            @else
                                            <span class="text-muted">Это вы</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <p class="mb-0 text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Всего пользователей: <strong>{{ $users->count() }}</strong>
                    </p>
                    <a href="{{ url('/') }}" class="btn btn-home">
                        <i class="fas fa-home me-1"></i>На главную
                    </a>
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-users-slash"></i>
                    <h4>Пользователи не найдены</h4>
                    <p class="text-muted">В системе пока нет зарегистрированных пользователей</p>
                    <a href="{{ url('/') }}" class="btn btn-home mt-3">
                        <i class="fas fa-home me-1"></i>На главную
                    </a>
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>