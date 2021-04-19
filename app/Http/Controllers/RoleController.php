<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', [
            'roles' => $roles,
        ]);
    }

    public function store(Request $request)
    {
        $inputs = $request->validate([
            'name' => 'required|unique:roles|min:3|max:255',
        ]);

        $inputs['name'] = preg_replace('/(\s|\t|\n)+/ui', " " , Str::title($inputs['name']));
        $inputs['slug'] = Str::of(Str::lower($inputs['name']))->slug('-');

        Role::create($inputs);

        $request->session()->flash('message_role', 'Роль была создана "' . $inputs['name'] . '"');

        return redirect()->route('role.index');
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', ['role' => $role]);
    }

    public function update(Request $request, Role $role)
    {
        $inputs = $request->validate([
            'name' => 'required|min:3|max:255',
        ]);

        $inputs['name'] = preg_replace('/(\s|\t|\n)+/ui', " " , Str::title($inputs['name']));
        $inputs['slug'] = Str::of(Str::lower($inputs['name']))->slug('-');

        $role->update($inputs);

        if ($role->isDirty('name')) {
            $request->session()->flash('message_role', 'Роль была изменина "' . $inputs['name'] . '"');
            return redirect()->route('role.index');
        } else {
            $request->session()->flash('message_role', 'Роль не изменилась "' . $role->name . '"');
            return redirect()->route('role.index');

        }

    }

    public function destroy (Role $role) 
    {
        $role->delete();
        Session::flash('message_role', 'Роль была удалена "' . $role->name . '"');
        return redirect(route('role.index'));
    }
}
