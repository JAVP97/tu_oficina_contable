<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Comuna;
use App\Models\Region;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //if(request()->ajax()) {
            // $cliente = Cliente::all();
            // return datatables()->of($cliente)
            // ->addColumn('region_id', function($cliente) {
            //     return $cliente->region->name;
            // })
            // ->addColumn('comuna_id', function($cliente) {
            //     return $cliente->comuna->name;
            // })
            // // ->addColumn('action', 'clientes.action')
            // // ->rawColumns(['action'])
            // ->addIndexColumn()
            //->toJson(true);
        //}
        return view('clientes/index');
    }

    public function listadoClientes(Request $request)
    {
        $clientes = Cliente::select('*')->get();
        return response()->json($clientes); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $comunas = Comuna::select('id', 'name', 'region_id')->orderBy('name', 'asc')->get();
        $regiones = Region::select('id', 'name')->orderBy('name', 'asc')->get();
        return view('clientes/create', compact('comunas', 'regiones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'personalidad' => 'required',
            'nombre_empresa' => 'required',
            'rut_empresa' => 'required|unique:clientes',
            'profesion' => 'required',
            'direccion' => 'required',
            'region_id' => 'required',
            'comuna_id' => 'required',
            'comentario' => 'required',
            'telefono' => 'required',
            'pass_sii' => 'required',
            'tasa_ppm' => 'required',
            'fecha_cobro' => 'required',
            
        ], [
            'personalidad.required' => 'Razon Social es requerido',
            'nombre_empresa' => 'Nombre de la empresa es requerido',
            'rut_cliente.required' => 'RUT es requerido',
            'rut_cliente.unique' => 'El cliente ya existe con este rut',
            'rutdv_cliente.required' => 'Dígito verificador es requerido',
            'profesion.required' => 'Profesion es requerido',
            'direccion.required' => 'Dirección es requerido',
            'region_id.required' => 'Región es requerido',
            'comuna_id.required' => 'Comuna es requerido',
            'comentario.required' => 'Comentario es requerido',
            'telefono.required' => 'Tlf es requerido',
            'pass_sii.required' => 'Tlf es requerido',
            'fecha_cobro.required' => 'Tlf es requerido',
        ]);

        Cliente::create($validatedData);
        
        return redirect()->back()->with('success','Cliente creado con éxito..');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $validatedData = $request->validate([
            'personalidad' => 'required',
            'nombre_empresa' => 'required',
            'rut_empresa' => 'required|unique:clientes',
            'profesion' => 'required',
            'direccion' => 'required',
            'region_id' => 'required',
            'comuna_id' => 'required',
            'comentario' => 'required',
            'telefono' => 'required',
            'pass_sii' => 'required',
            'tasa_ppm' => 'required',
            'fecha_cobro' => 'required',
            
        ], [
            'personalidad.required' => 'Razon Social es requerido',
            'nombre_empresa' => 'Nombre de la empresa es requerido',
            'rut_cliente.required' => 'RUT es requerido',
            'rut_cliente.unique' => 'El cliente ya existe con este rut',
            'rutdv_cliente.required' => 'Dígito verificador es requerido',
            'profesion.required' => 'Profesion es requerido',
            'direccion.required' => 'Dirección es requerido',
            'region_id.required' => 'Región es requerido',
            'comuna_id.required' => 'Comuna es requerido',
            'comentario.required' => 'Comentario es requerido',
            'telefono.required' => 'Tlf es requerido',
            'pass_sii.required' => 'Tlf es requerido',
            'fecha_cobro.required' => 'Tlf es requerido',
        ]);

        $cliente = Cliente::find($id);
        $cliente->fill($validatedData)->save();

        return response()->json($cliente);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        //
        $cliente = Cliente::find($id);
        $cliente->delete();
        return redirect()->back()->with('success', 'Wliminado con exito!');
        
    }
}
