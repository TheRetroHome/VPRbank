<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserService{
    /**
     * Регистрирует нового пользователя и сразу выполняет вход в систему
     *
     * @param array $userData Массив с данными пользователя:
     *                        - name     (string) - имя пользователя
     *                        - email    (string) - email
     *                        - password (string) - пароль в открытом виде
     *
     * @return User Созданный и авторизованный пользователь
     */
    public function register(array $userData){
        $user = User::create([
            'name'      => $userData['name'],
            'email'     => $userData['email'],
            'password'  => Hash::make($userData['password'])
        ]);

        Auth::login($user);

        return $user;
    }

    /**
     * Пытается выполнить вход пользователя в систему
     *
     * @param array $credentials Массив с учетными данными:
     *                           - email    (string)
     *                           - password (string)
     * @param bool  $remember    Запомнить пользователя (функция "Запомнить меня")
     *
     * @return bool true - если вход успешен, false - в противном случае
     */
    public function attemptToLogin(array $credentials, bool $remember = false) : bool {
        return Auth::attempt($credentials, $remember);
    }

    /**
     * Регенерирует идентификатор сессии (защита от session fixation)
     *
     * Объект HTTP-запроса
     *
     * @return void
     */
    public function regenerateSession($request) : void{
        $request->session()->regenerate();
    }

    /**
     * Получить авторизованного пользователя с загруженными транзакциями
     */
    public function getUserProfile(): User
    {
        return Auth::user()->load('transactions');
    }

    /**
     * Обновление данных пользователя
     *
     * @param array $data Валидированные данные из формы
     * @return bool
     */
    public function updateProfile(array $data): bool
    {
        $user = Auth::user();
        return $user->update($data);
    }
}