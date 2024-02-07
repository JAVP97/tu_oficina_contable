<?php

namespace App\Http\Controllers;

use App\Models\FormaPago;
use Illuminate\Http\Request;

class FormaPagoController extends Controller
{

    public function index()
    {
        $forma_pago = FormaPago::all();
       return view('forma-pagos.index', compact('forma_pago'));
    }

    public function store(Request $request)
    {
        $formaPago = new FormaPago();
        $formaPago->nombre_fp = $request->nombre_fp;
        $formaPago->save();

        return redirect('forma-pago')->with('success','Forma de pago creado con éxito..');
    }

    public function edit(FormaPago $formaPago)
    {
        $forma_pago = FormaPago::all();
        $formaPago->find($formaPago->id);
        return view('forma-pagos.edit', compact('forma_pago', 'formaPago'));
    }

    public function update(Request $request, FormaPago $formaPago)
    {
        $formaPago->find($formaPago->id);
        $formaPago->nombre_fp = $request->nombre_fp;
        $formaPago->save();
        return redirect('forma-pago')->with('success','Forma de pago actualizado con éxito..');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
       return $m_mone=FormaPago::find($id);
        $count=0;
        // $count+=count($m_mone->tabla1);
        // $count+=count($m_mone->tabla2);
        // $count+=count($m_mone->tabla3);
        if($count>0){
           return ['msg'=>'Elemento en uso'];
        }else{
           $m_mone->fill($request->all());
           $m_mone->save();
           return $m_mone;
        }
    }

    public function formasPagagosJson()
    {
        $forma_pago = FormaPago::all();
        return response()->json($forma_pago);
    }
}
