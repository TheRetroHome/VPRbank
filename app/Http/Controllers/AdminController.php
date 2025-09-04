<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function info(){
        $users = User::select('id', 'name', 'email', 'password', 'created_at')->get();
        return view('info', compact('users'));
    }

    public function deleteUser($id){
        try{
            $user = User::findOrFail($id);

            if($user->id === Auth::id()){
                return redirect('/')->with('error', 'Вы не можете удалить свой собственный аккаунт');
            }
            $user->delete();

            return redirect('/')->with('success', 'Пользователь удалён');
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect('/')
                ->with('error', 'Пользователь не найден!');
        } catch (\Exception $e) {
            return redirect('/')
                ->with('error', 'Произошла ошибка при удалении: ' . $e->getMessage());
        }
    }
}
