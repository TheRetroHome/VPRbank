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
        
        @if($users->count() > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Имя</th>
                        <th>Email</th>
                        <th>Дата регистрации</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
    <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
            <form action="{{ url('admin/users/' . $user->id) }}" method="POST" 
                  onsubmit="return confirm('Вы уверены что хотите удалить этого пользователя?')">
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