<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddMoneyRequest extends FormRequest
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
                'amount'            => ['required', 'numeric', 'min:10', 'max:100000'],
                'payment_method'    => ['required', 'in:card,qiwi'],
            ];
    }

    public function messages() : array
    {
        return [
            'amount.required'      => 'Сумма обязательна',
            'amount.numeric'       => 'Сумма должна быть числовым значением',
            'amount.min'           => 'Сумма должна быть больше 10 рублей',
            'amount.max'           => 'Сумма не должна быть больше 100 000 рублей',

            'payment_method.required'  => 'Метод пополнения обязателен',
            'payment_method.in'        => 'Метод пополнения должен быть по карте либо по qiwi',

        ];
    }
}
