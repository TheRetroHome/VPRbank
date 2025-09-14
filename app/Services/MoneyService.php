<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class MoneyService{
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
}