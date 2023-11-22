<?php


namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function showForm()
    {
        $users = User::all();
        $roles = Role::all();
        $permissions = Permission::all();

        return view('assign-roles-permissions', compact('users', 'roles', 'permissions'));
    }

    public function assign(Request $request)
    {
        $user = User::findOrFail($request->input('user_id'));

        $roles = $request->input('roles', []);
        $permissions = $request->input('permissions', []);

        $user->syncRoles($roles);

        
        $user->syncPermissions($permissions);
        
        return redirect()->back()->with('success', 'Roles and permissions assigned successfully.');
    }
}
