<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\User\UserUpdateRequest;
use Illuminate\Support\Facades\Auth;
use App\Services\UserService;;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService){
        $this->userService = $userService;
    }

    public function getProfile()
    {
        $user = $this->userService->getUserProfile();

        return view('user.profile', compact('user'));
    }

    public function update(UserUpdateRequest $request)
    {
        $validated = $request->validated();

        $this->userService->updateProfile($validated);

        return redirect('/users/profile')
            ->with('success', 'Данные пользователя успешно обновлены');
    }
}
