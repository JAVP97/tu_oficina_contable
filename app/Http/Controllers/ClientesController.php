<?php

namespace App\Http\Controllers;

use App\Models\Comuna;
use App\Models\Region;
use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Models\OpcionesCliente;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = DB::table('clientes')->paginate(10);
        return view('clientes.index', compact('clientes'));
    }
    
    function fetch_data(Request $request)
    {
        if($request->ajax())
        {
            $clientes = DB::table('clientes')->paginate(10);
            return view('clientes.pagination_data', compact('clientes'))->render();
        }
    }

    public function create()
    {
        $comunas = Comuna::select('id', 'name', 'region_id')->orderBy('name', 'asc')->get();
        $regiones = Region::select('id', 'name')->orderBy('name', 'asc')->get();
        return view('clientes.create', compact('comunas', 'regiones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
            'pass_sii.required' => 'Contraseña SII es requerido',
            'fecha_cobro.required' => 'Fecha de Cobro es requerido',
        ]);

        $cliente = Cliente::create($validatedData);

        $clienteOpc = new OpcionesCliente;
        $clienteOpc->notificar = $request->notificar;
        $clienteOpc->emails = $request->emails;
        $clienteOpc->exento_iva = $request->exento_iva;
        $clienteOpc->importaciones = $request->importaciones;
        $clienteOpc->remuneraciones = $request->remuneraciones;
        $clienteOpc->contabilidad = $request->contabilidad;
        $clienteOpc->facturacion = $request->facturacion;
        $clienteOpc->cliente_id = $cliente->id;
        $clienteOpc->save(); 
        
        return redirect('clientes')->with('success','Cliente creado con éxito..');
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

    public function getRegion(Request $request)
    {
        if ($request->ajax()) {
            $comunas = Comuna::where('region_id', $request->region)->get();
            foreach ($comunas as $comuna) {
                $comunasArray[$comuna->id] = $comuna->name;
            }
            return response()->json($comunasArray);
        }
    }
}
