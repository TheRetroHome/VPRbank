<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
        $userId = auth()->id();
        return [
            'name'  => ['string', 'unique:users', 'max:50', 'min:5'],
            'email' => ['email', Rule::unique('users')->ignore($userId)],
        ];
    }

    public function messages() : array
    {
        return [
            'name.string'        => 'Имя пользователя должно быть строкой',
            'name.unique'        => 'Это имя пользователя уже занято',
            'name.max'           => 'Превышен лимит символов в имени пользователя',
            'name.min'           => 'Недостаточно символов в имени пользователя',
            
            'email.email'        => 'Email должен быть в формате почты',
            'email.unique'       => 'Этот email адрес уже занят',
        ];
    }
}
