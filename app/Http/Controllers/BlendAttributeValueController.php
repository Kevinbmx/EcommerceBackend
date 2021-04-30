<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlendAttributeValueController extends Controller
{
    public function store(Request $request)
    {
        return $request;
        $this->validate($request, [
            'product_id' => 'required',
            'atributoValor_id'=>'required',
            // 'atributoValorB_id'=>'required',
            'uniqueCode'=>'required',
        ]);

        // $blenAttributeValue = BlendAttributeValue::create([
        //     'product_id' => $request->product_id,
        //     'atributoValor_id'=>$request->atributoValor_id,
        //     'atributoValorB_id'=>$request->atributoValorB_id,
        //     'uniqueCode'=>$request->uniqueCode
        // ]);
        // return response()
        //     ->json(array(
        //         'saved' => true,
        //         'blendBttributeValueId'=>$blenAttributeValue->id
        //     ),200);
    }
}
