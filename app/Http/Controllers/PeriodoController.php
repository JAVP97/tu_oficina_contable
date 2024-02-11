<?php

namespace App\Http\Controllers;

use App\Models\Periodo;
use Illuminate\Http\Request;
use App\Models\ClientePeriodo;

class PeriodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $validatedData = $request->validate([
            'periodo' => 'required|unique:periodos',
            
        ], [
            'periodo.required' => 'Periodo es requerido',
        ]);

        $periodo = Periodo::create($validatedData);

        $longitud = count($request->cliente_id);

        for($i=0; $i<$longitud; $i++)
        {
            $cliente_periodo = new ClientePeriodo();
            $cliente_periodo->periodo_id = $periodo->id;
            $cliente_periodo->cliente_id = $request->cliente_id[$i];
            $cliente_periodo->save();
        }

        return redirect()->back()->with('success','Periodo creado con éxito..');
    }

    /**
     * Display the specified resource.
     */
    public function show(Periodo $periodo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Periodo $periodo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $status = ($request->periodo_cerrado == 'Si') ? 'No' : 'Si' ;
        $periodo = Periodo::where("id", $id)->update(["periodo_cerrado" => $status]);
        return response()->json($periodo);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Periodo $periodo)
    {
        //
    }
}
