<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
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
            'title'         => ['required', 'string', 'min:10', 'max:70'],
            'content'       => ['required', 'string', 'min:100'],
            'is_active'     => ['required', 'boolean'],
        ];
    }

    public function messages() : array 
    {
        return [
            'title.required'    => 'Заголовок обязателен для заполнения',
            'title.string'      => 'Заголовок должен быть строкой',
            'title.min'         => 'Слишком мало символов в заголовке',
            'title.max'         => 'Слишком много символов в заголовке',

            'content.required'  => 'Содержимое поста обязательно для заполнения',
            'content.string'    => 'Контент должен быть строкой',
            'content.min'       => 'Слишком мало символов в содержимом поста',

            'is_active.required'         => 'Опубликовать сразу или нет обязательно',
            'is_active.boolean'          => 'Опубликовать сразу или нет должно быть boolean типа'
        ];
    }
}
