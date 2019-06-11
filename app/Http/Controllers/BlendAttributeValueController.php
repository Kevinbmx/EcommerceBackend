<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\BlendAttributeValue;

class BlendAttributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
