<?php

namespace App\Http\Controllers;

use App\Models\LibroBanco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LibroBancoController extends Controller
{

    public function index()
    {
        return view('LibroBancos.index');
    }

    public function ListadoGet()
    {
      return  $LibroBanco = LibroBanco::all();
        return response()->json($LibroBanco);
    }

    public function store(Request $request)
    {
        $valor = LibroBanco::select('saldo')->orderBy('id', 'desc')->first()->saldo;
        if ($request->tipo_operacion == 'Honorarios' || $request->tipo_operacion == 'Ingresos') {
           $saldo =  $request->debe + $valor;
        } else if($request->tipo_operacion == 'Gastos'){
            $saldo =  $valor - $request->haber;
        }
        $validator = Validator::make($request->all(), [
            'fecha_ingreso' => 'required',
            'tipo_operacion' => 'required',
            'fecha_periodo' => 'required',
            'descripcion' => 'required',
            'factura' => 'required',
            'debe' => '',
            'haber' => '',
        ]);
        if ($validator->passes()) {
          $LibroBancos = new LibroBanco;
          $LibroBancos->fecha_ingreso = $request->fecha_ingreso;
          $LibroBancos->tipo_operacion = $request->tipo_operacion;
          $LibroBancos->fecha_periodo = $request->fecha_periodo;
          $LibroBancos->descripcion = $request->descripcion;
          $LibroBancos->factura = $request->factura;
          $LibroBancos->debe = $request->debe;
          $LibroBancos->haber = $request->haber;
          $LibroBancos->saldo = $saldo;
          if($LibroBancos->save()){
           return response()->json($LibroBancos);
         }
        }else{
          return response()->json($validator->errors()->all());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(LibroBanco $libroBanco)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LibroBanco $libroBanco)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LibroBanco $libroBanco)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LibroBanco $libroBanco)
    {
        //
    }
}
