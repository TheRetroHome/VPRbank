<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MoneyController extends Controller
{
    public function moneyStatic(){
        return view('money.money');
    }
}
