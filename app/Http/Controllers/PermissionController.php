<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permissions.index', [
            'permissions' => $permissions,
        ]);
    }

    public function store(Request $request)
    {
        $inputs = $request->validate([
            'name' => 'required|unique:permissions|min:3|max:255',
        ]);

        $inputs['name'] = preg_replace('/(\s|\t|\n)+/ui', " " , Str::title($inputs['name']));
        $inputs['slug'] = preg_replace('/(\s|\t|\n)+/ui', "-" , Str::lower($inputs['name']));

        Permission::create($inputs);

        $request->session()->flash('message_permission', 'Права были созданы "' . $inputs['name'] . '"');

        return redirect()->route('permission.index');
    }

    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', [
            'permission' => $permission,
            'roles' => Role::all(),
            ]);
    }

    public function update(Permission $permission, Request $request)
    {
        $inputs = $request->validate([
            'name' => 'required|min:3|max:255',
        ]);

        $inputs['name'] = preg_replace('/(\s|\t|\n)+/ui', " " , Str::title($inputs['name']));
        $inputs['slug'] = preg_replace('/(\s|\t|\n)+/ui', "-" , Str::lower($inputs['name']));

        $permission->fill($inputs);

        if ($permission->isDirty('name')) {
            $request->session()->flash('message_permission', 'Права были изменина "' . $inputs['name'] . '"');
            $permission->save();
            return redirect()->route('permission.index');
        } else {
            $request->session()->flash('message_permission', 'Права не изменились "' . $permission->name . '"');
            return back();
        }
    }

    public function attach(Permission $permission, Request $request)
    {
        $permission->roles()->attach($request->role);
        return back();
    }

    public function detach(Permission $permission, Request $request)
    {
        $permission->roles()->detach($request->role);
        return back();
    }

    public function destroy (Permission $permission) 
    {
        $permission->delete();
        Session::flash('message_role', 'Права были удалены "' . $permission->name . '"');
        return redirect(route('permission.index'));
    }
}
