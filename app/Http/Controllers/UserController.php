<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function show(User $user)
    {
        return view('admin.users.show', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $inputs = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'alpha_dash'],
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
}
