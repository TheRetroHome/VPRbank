<?php

namespace App\Http\Requests\Message;

use Illuminate\Foundation\Http\FormRequest;

class CreateMessageRequest extends FormRequest
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
            'recipient_id'  => ['required', 'integer', 'exists:users,id', 'different:sender_id'],
            'content'       => ['required', 'string', 'min:1', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'recipient_id.required'   => 'Выберите получателя сообщения',
            'recipient_id.integer'    => 'Неверный идентификатор пользователя',
            'recipient_id.exists'     => 'Выбранный пользователь не существует',
            'recipient_id.different'  => 'Нельзя отправить сообщение самому себе',

            'content.required'        => 'Введите текст сообщения',
            'content.min'             => 'Сообщение не может быть пустым',
            'content.max'             => 'Сообщение слишком длинное. Максимум 2000 символов',
        ];
    }
}
