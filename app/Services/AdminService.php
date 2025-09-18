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
                    'redirect'  => 'admin/info'
                ];
            }
            $user->delete();

            return [
                'success'    => true,
                'message'   => 'Пользователь успешно удалён',
                'redirect'  => 'admin/info'
            ];
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return [
                'success'    => false,
                'message'   => 'Пользователь не найден',
                'redirect'  => 'admin/info'
            ];
        } catch (\Exception $e) {
            return [
                'success'    => false,
                'message'   => "Произошла ошибка при удалении - " . $e->getMessage(),
                'redirect'  => 'admin/info'
            ];
        }
    }

    public function setAdmin ($is_admin, $id){
        try{
            $user = User::findOrFail($id);

            if($user->id === Auth::id()){
                return [
                    'success' => false,
                    'message' => 'Вы не можете лишить самого себя прав администратора',
                    'redirect'=> 'admin/info'
                ];
            }
            $role = $user->role == 'Администратор' ? 'Клиент' : 'Администратор';
            $user->update(['is_admin' => $is_admin, 'role'  => $role]);

            return [
                'success'   => true,
                'message'   => 'Права администратора успешно сменились',
                'redirect'  => 'admin/info'
            ];
        }

        catch (\Exception $e){
            return [
                'success'   => false,
                'message'   => "Произошла ошибка - " . $e->getMessage(),
                'redirect'  => 'admin/info'
            ];
        }
    }
}