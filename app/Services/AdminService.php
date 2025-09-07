<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AdminService{
    
    public function deleteUser($id){
        try{
            $user = User::findOrFail($id);

            if($user->id === Auth::id()){
                return [
                    'success'    => false,
                    'message'   => 'Вы не можете удалить свой собственный аккаунт',
                    'redirect'  => '/'
                ];
            }
            $user->delete();

            return [
                'success'    => true,
                'message'   => 'Пользователь успешно удалён',
                'redirect'  => '/'
            ];
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return [
                'success'    => true,
                'message'   => 'Пользователь не найден',
                'redirect'  => '/'
            ];
        } catch (\Exception $e) {
            return [
                'success'    => true,
                'message'   => "Произошла ошибка при удалении - $e->getMessage()",
                'redirect'  => '/'
            ];
        }
    }
}