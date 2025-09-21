<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\User\UserUpdateRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getProfile(){
        $user = Auth::user()->load('transactions');
        return view('user.profile', compact('user'));
    }

    public function update(UserUpdateRequest $request){
        $user = Auth::user();
        $validated = $request->validated();
        $user->update($validated);
        return redirect('/users/profile')->with('success','Данные пользователя успешно обновлены');
    }
}
