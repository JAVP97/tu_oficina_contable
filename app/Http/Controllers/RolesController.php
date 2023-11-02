<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    public function index()
    {
        return view('usuarios.roles.index',[
            'roles' => Role::all()
        ]);
    }

    public function create()
    {
        return view('usuarios.roles.create',[
            'role' => new Role,
            'permissions' => Permission::pluck('name', 'id')
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required|unique:roles',
                'guard_name' => 'required'
            ],
            [
                'name.required' => 'El campo identificador es oblicatorio',
                'name.unique' => 'El campo identificador ya existe registrado',

                'guard_name.required' => 'El campo Nombre es oblicatorio',
            ]
        );

        $role = Role::create($data);
        
        if ($request->has('permissions'))
        {
            $role->givePermissionTo($request->permissions);
        }

        return redirect()->route('roles.index')->with('success', 'El Role fue creado correctamente');
    }
    public function edit(Role $role)
    {
        return view('usuarios.roles.edit', [
            'role' => $role,
            'permissions' =>  Permission::pluck('name', 'id'),
        ]);
    }
    
    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);

        $role->update($data);
        
        $role->permissions()->detach();

        if ($request->has('permissions'))
        {
            $role->givePermissionTo($request->permissions);
        }
         
        return redirect()->route('roles.edit', $role)->with('success', 'El Role fue actualizado correctamente');
    }
}
