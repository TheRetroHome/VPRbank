<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddMoneyRequest;
use Illuminate\Support\Facades\Auth;
use App\Services\MoneyService;

class MoneyController extends Controller
{
    protected $moneyService;

    public function __construct(MoneyService $moneyService){
        $this->moneyService = $moneyService;
    }

    public function moneyStatic(){
        return view('money.money');
    }

    public function addMoney(AddMoneyRequest $request){
        try{
            $amount = $this->moneyService->addMoneyMethod($request->validated());

            return redirect('/')->with('success', "Баланс успешно пополнен на {$amount} ₽");
        }
        catch(\Exception $e){
            return redirect('/')->with('error', "Произошла ошибка при пополнении баланса" . $e->getMessage())
            ->withInput();
        }
    }

    public function moneyHistory(){
        $transactions = $this->moneyService->getHistoryMethod();

        return view('money.history', compact('transactions'));
    }
}
