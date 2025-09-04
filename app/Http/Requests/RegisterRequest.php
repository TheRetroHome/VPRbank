<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'      => ['required', 'string', 'unique:users', 'max:50', 'min:5'],
            'email'     => ['required', 'email', 'unique:users'],
            'password'  => ['required', 'max:50', 'min:8'],
        ];
    }

    public function messages() : array
    {
        return [
            'name.required'      => 'Имя пользователя обязательно для заполнения',
            'name.string'        => 'Имя пользователя должно быть строкой',
            'name.unique'        => 'Это имя пользователя уже занято',
            'name.max'           => 'Превышен лимит символов в имени пользователя',
            'name.min'           => 'Недостаточно символов в имени пользователя',

            'email.required'     => 'Email обязателен для заполнения',
            'email.email'        => 'Email должен быть в формате почты',
            'email.unique'       => 'Этот email адрес уже занят',

            'password.required'  => 'Пароль обязателен для заполнения',
            'password.max'       => 'Превышен лимит символов в пароле',
            'password.min'       => 'Недостаточно символов в пароле',
        ];
    }
}
