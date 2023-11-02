<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersRolesController extends Controller
{
    public function update(Request $request, User $user)
    {
        $user->syncRoles($request->roles);

        return redirect()->back()->with('success', '¡Roles de usuario actualizado!');
    }
}
