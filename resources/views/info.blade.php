<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Информация о пользователях</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Список пользователей</h1>
        
        <!-- Сообщения -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        
        @if($users->count() > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Имя</th>
                        <th>Email</th>
                        <th>Админ</th>  
                        <th>Дата регистрации</th>  
                        <th>Действия</th>  
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->is_admin)
                                <span class="badge bg-success">Да</span>
                            @else
                                <span class="badge bg-secondary">Нет</span>
                            @endif
                        </td>
                        <td>{{ $user->created_at->format('d.m.Y H:i') }}</td>
                        <td>
                            <!-- Кнопка изменения прав -->
                            @if($user->id !== Auth::id())
                            <form action="{{ route('users.setAdmin', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="is_admin" value="{{ $user->is_admin ? 0 : 1 }}">
                                <button type="submit" class="btn btn-warning btn-sm">
                                    {{ $user->is_admin ? 'Забрать права' : 'Сделать админом' }}
                                </button>
                            </form>
                            @endif
                            
                            <!-- Кнопка удаления -->
                            <form action="{{ route('users.delete', $user->id) }}" method="POST" 
                                  onsubmit="return confirm('Вы уверены?')" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    Удалить
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="mt-3">
                <p>Всего пользователей: <strong>{{ $users->count() }}</strong></p>
            </div>
        @else
            <div class="alert alert-info">
                Пользователи не найдены
            </div>
        @endif
        
        <a href="{{ url('/') }}" class="btn btn-primary">На главную</a>
    </div>
</body>
</html>