<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Hotel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role', 'hotel')->get();
        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $hotels = Hotel::all();
        return view('admin.users.edit', compact('user', 'roles', 'hotels'));
    }

    public function update(Request $request, User $user)
    {
        User::find($user->id)->update($request->all());
        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user)
    {
        User::find($user->id)->delete();
        return redirect()->route('admin.users.index');
    }
}

