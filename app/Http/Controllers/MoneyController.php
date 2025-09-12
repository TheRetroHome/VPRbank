<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddMoneyRequest;
use Illuminate\Support\Facades\Auth;

class MoneyController extends Controller
{
    public function moneyStatic(){
        return view('money.money');
    }

    public function addMoney(AddMoneyRequest $request){
        $validator = $request->validated();

        try{
            $user = Auth::user();

            $amount = $request->amount;

            $description = match($request->payment_method){
                'card' => 'Пополнение баланса с помощью карты',
                'qiwi' => 'Пополнение баланса с помощью киви',
                default => 'Пополнение баланса',
            };

            $user->deposit($amount, $description);

            return redirect('/')->with('success', "Баланс успешно пополнен на {$amount} ₽");
        }
        catch(\Exception $e){
            return redirect('/')->with('error', "Произошла ошибка при пополнении баланса" . $e->getMessage())
            ->withInput();
        }
    }

    public function moneyHistory(){
        $transactions = Auth::user()->transactions()
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return view('money.history', compact('transactions'));
    }
}
