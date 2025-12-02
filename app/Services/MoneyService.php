<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MoneyService{

    /**
     * Доступные типы услуг с иконками и названиями
     */
    private const SERVICE_TYPES = [
        'steam'          => ['name' => 'Steam',                'icon' => 'fab fa-steam'],
        'mobile'         => ['name' => 'Мобильная связь',     'icon' => 'fas fa-mobile-alt'],
        'internet'       => ['name' => 'Интернет',            'icon' => 'fas fa-wifi'],
        'food_delivery'  => ['name' => 'Доставка еды',        'icon' => 'fas fa-utensils'],
        'utilities'      => ['name' => 'Коммунальные услуги', 'icon' => 'fas fa-home'],
        'entertainment'  => ['name' => 'Развлечения',         'icon' => 'fas fa-gamepad'],
        'transport'      => ['name' => 'Транспорт',           'icon' => 'fas fa-bus'],
    ];

    public function addMoneyMethod(array $moneyData){
        return DB::transaction(function () use($moneyData){
            $user = Auth::user();

            $description = match($moneyData['payment_method']){
                'card'  => 'Пополнение баланса с помощью карты',
                'qiwi'  => 'Пополнение баланса с помощью qiwi',
                default => 'Пополнение баланса'
            };

            $user->increment('cash', $moneyData['amount']);

            $user->transactions()->create([
                'type' => 'deposit',
                'amount' => $moneyData['amount'],
                'description' => $description,
                'status' => 'completed'
            ]);

            return (float) $moneyData['amount'];
        });
    }

    public function getHistoryMethod(){
        $transactions = Auth::user()->transactions()
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return $transactions;
    }

    /**
     * Обработка оплаты услуги
     *
     * @param array $data — валидированные данные: service_type, amount, account, description
     * @return array — success, message, service_name, icon (для редиректа или JSON)
     */
    public function processPayment(array $data): array
    {
        $user = Auth::user();

        // Проверка существования типа услуги
        if (!isset(self::SERVICE_TYPES[$data['service_type']])) {
            throw new \InvalidArgumentException('Выбранная услуга недоступна.');
        }

        $service = self::SERVICE_TYPES[$data['service_type']];
        $description = $data['description']
            ? trim($data['description'])
            : "Оплата {$service['name']} — {$data['account']}";

        // Списание средств
        $user->withdraw((float) $data['amount'], $description);

        return [
            'success'      => true,
            'message'      => "Оплата {$service['name']} на сумму {$data['amount']} ₽ прошла успешно!",
            'service_name' => $service['name'],
            'icon'         => $service['icon'],
        ];
    }

    /**
     * Получить список всех доступных услуг (для форм, селектов и т.д.)
     */
    public function getAvailableServices(): array
    {
        return self::SERVICE_TYPES;
    }

    /**
     * Получить данные об одной услуге по ключу
     */
    public function getService(string $type): array
    {
        return self::SERVICE_TYPES[$type]
            ?? throw new \InvalidArgumentException("Услуга {$type} не найдена");
    }
}