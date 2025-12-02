<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Money\AddMoneyRequest;
use App\Http\Requests\Money\PaymentRequest;
use Illuminate\Support\Facades\Auth;
use App\Services\MoneyService;
use App\Exports\TransactionsExport;
use Maatwebsite\Excel\Facades\Excel;

class MoneyController extends Controller
{
    protected $moneyService;

    public function __construct(MoneyService $moneyService){
        $this->moneyService = $moneyService;
    }

    public function moneyStatic(){
        return view('money.money');
    }

    /**
     * Пополнение баланса
     *
     * @param AddMoneyRequest $request Принимает - [amount, payment_method]
     * @return void
     */
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

    public function moneyExport(){
        $filename = 'vpr_bank_transactions_' . now()->format('d_m_Y_H_i') . '.xlsx';

        return Excel::download(new TransactionsExport, $filename);
    }

    public function paymentStatic() {
        return view('money.payment');
    }

    public function processPayment(PaymentRequest $request): RedirectResponse
    {
        try {
            $result = $this->moneyService->processPayment($request->validated());

            return redirect('/')->with('success', $result['message']);

        } catch (\Exception $e) {
            return back()
                ->with('error', $e->getMessage() ?: 'Не удалось провести оплату. Недостаточно средств?')
                ->withInput();
        }
    }
}
