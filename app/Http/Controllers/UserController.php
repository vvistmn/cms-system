<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {   
        $users = User::all();
        return view('admin.users.index', ['users' => $users]);
    }

    public function show(User $user)
    {
        $roles = Role::all();
        return view('admin.users.show', [
            'user' => $user,
            'roles' => $roles
            ]);
    }

    public function update(Request $request, User $user)
    {
        $inputs = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'avatar' => ['file']
        ]);

        if (!empty($request->avatar)) {
            $inputs['avatar'] = $request->avatar->store('images');
        } else {
            $inputs['avatar'] = $user->avatar;
        }

        $user->update($inputs);

        return back();
    }
    
    public function attach(User $user, Request $request)
    {
        $user->roles()->attach($request->role);
        return back();
    }

    public function detach(User $user, Request $request)
    {
        $user->roles()->detach($request->role);
        return back();
    }

    public function destroy(User $user)
    {
        $user->delete();
        Session::flash('message_users', 'Пользователь был удален "' . $user->name . '"');
        return redirect(route('user.index'));
    }
}