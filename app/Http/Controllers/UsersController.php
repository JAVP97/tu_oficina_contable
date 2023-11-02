<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class UsersController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $user = new User();
        $roles = Role::with('permissions')->get();
        $permissions = Permission::pluck('name', 'id');
        return view('usuarios.create', compact('user', 'roles', 'permissions'));
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'rut' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['confirmed', 'min:6'],
            'is_admin' => [''],
        ]);
        $messages = [
            'name.required' => 'Agregar un nombre de usuario.',
            'name.max' =>'El nombre del usuario no puede ser mayor a :max caracteres.',
            'rut.unique' => 'El RUT ya esta en uso.',
            'email.unique' => 'El Correo electronico ya esta en uso.',
            'password.confirmed' => 'Debe confirmar la contraseña',
        ];
        $user = User::create($data, $messages);

        $user->assignRole($request->roles);

        $user->givePermissionTo($request->permissions);

        return redirect()->route('users.index')->with('success', '¡Usuario Guardado!');
    }
    public function show(User $user)
    {
        return view('usuarios.show', compact('user'));
    }
    public function edit(User $user)
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::pluck('name', 'id');
        return view('usuarios.edit', compact('user', 'roles', 'permissions'));
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required',
            'rut' => ['required',  Rule::unique('users')->ignore($user->id)],
            'email' => ['required', Rule::unique('users')->ignore($user->id)],
            'is_admin' => [''],
        ];

        if ($request->filled('password')) {
            $rules['password'] = ['confirmed', 'min:6'];
        } 

        $data = $request->validate($rules);

        $user->update($data);

        return redirect('users')->with('success', '¡Usuario actualizado!');
    }

    public function destroy($id)
    {
        if (auth()->user()->id == $id) {
            return redirect()->back()->with('info', 'No se puede eliminar el usuario logueado.');
        } else {
            User::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'Usuario Eliminado con exito!');
        }
    }
    public function ValidarRutUser(Request $request)
    {
        $data = User::where('rut', '=', $request->rut)->exists();
        return response()->json($data);
    }
}
