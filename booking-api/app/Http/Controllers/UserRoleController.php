<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    public function assignRoleToUser(Request $request, $userId, $roleName)
    {
        // Find user by ID
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Find role by name
        $role = Role::where('name', $roleName)->first();

        if (!$role) {
            return response()->json(['error' => 'Role not found'], 404);
        }

        // Attach role to user
        $user->roles()->attach($role->id);

        return response()->json(['message' => 'Role assigned successfully']);
    }
}
