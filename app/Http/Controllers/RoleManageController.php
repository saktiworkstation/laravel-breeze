<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleManageController extends Controller
{
    public function index(){
        return view('role-manage.index', [
            'datas' => User::with('roles')->get(),
        ]);
    }

    public function create(){
        return view('role-manage.create', [
            'users' => User::latest()->get(),
            'roles' => Role::latest()->get(),
        ]);
    }

    public function store(Request $request){
        // dd($request->all());

        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($validatedData['user_id']);
        $role = Role::findOrFail($validatedData['role_id']);

        $user->assignRole($role->name);

        return redirect('role-manag')->with('success', 'Role assigned successfully!');
    }

    public function removeUserRole(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->removeRole($request->role);

        return redirect('role-manag')->with('success', 'Role removed successfully!');
    }
}
