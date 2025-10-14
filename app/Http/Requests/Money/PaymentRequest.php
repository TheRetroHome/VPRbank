<?php

namespace App\Http\Requests\Money;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'service_type'  => ['required','in:steam,mobile,internet,food_delivery,utilities,entertainment,transport'],
            'amount'        => ['required', 'numeric', 'min:1', 'max:100000'],
            'account'       => ['required', 'string', 'max:255'],
            'description'   => ['nullable', 'string', 'max:500']
        ];
    }

    public function messages(): array
    {
        return [
            'service_type.required'     => 'Выберите тип услуги',
            'amount.required'           => 'Введите сумму оплаты',
            'amount.min'                => 'Минимальная сумма оплаты 1 рубль',
            'amount.max'                => 'Максимальная сумма оплаты 100 000 рублей',
            'account.required'          => 'Введите номер счета/телефона'
        ];
    }
}