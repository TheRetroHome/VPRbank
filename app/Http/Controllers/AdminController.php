<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Services\AdminService;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService){
        $this->adminService = $adminService;
    }
    /**
     * Scope userSelect selects id, name, emails, password, created_at
     */
    public function info(){
        $users = User::userSelect()->get();
        return view('info', compact('users'));
    }

    public function deleteUser($id){
        $result = $this->adminService->deleteUser($id);
        return redirect($result['redirect'])
            ->with($result['message'] ? 'success' : 'error', $result['message']);
    }

    public function setAdmin(Request $request, $id){
        $is_admin = $request->onlyo('is_admin', false);
        $user = $this->adminService->setAdmin($is_admin, $id);
        return redirect($result['redirect'])
            ->with($result['message'] ? 'success' : 'error', $result['message']);
    }
}
