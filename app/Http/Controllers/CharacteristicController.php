<?php

namespace App\Http\Controllers;

use App\Model\characteristic;
use Illuminate\Http\Request;

class CharacteristicController extends Controller
{
    /**
     * Display a listing of the resource by productId.
     *
     * 
     */
    public function getByProductId($productId)
    {
        $characteristicByProductId = Characteristic::where('product_id',$productId)->get();
        return $characteristicByProductId;
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
        $this->validate($request, [
            'product_id' => 'required',   
            'characteristic' => 'required',
            
        ]);
        $characteristic = Characteristic::create([
            'product_id' => $request->product_id,
            'characteristic' => $request->characteristic,
        ]);
        // $CharacteristicObj = Characteristic::find($characteristic->id);
      
        return response()
            ->json([
                'response' => 'success',
                'saved' => true,
                'type'=> 'create',
                'id'=>$characteristic->id,
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\characteristic  $characteristic
     * @return \Illuminate\Http\Response
     */
    public function show(characteristic $characteristic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\characteristic  $characteristic
     * @return \Illuminate\Http\Response
     */
    public function edit(characteristic $characteristic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\characteristic  $characteristic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'product_id' => 'required',   
            'characteristic' => 'required',
            'path'=> 'required',
            'pathName'=>'required'
        ]);
        $characteristic = Characteristic::findOrFail($id);
        $characteristic->update([
            'product_id' => $request->product_id,
            'characteristic' => $request->characteristic,
            'path' => $request->path,
            'pathName' => $request->pathName
        ]);
        return response()
        ->json([
            'response' => 'success',
            'saved' => true,
            'type'=> 'update',
            'id'=>$characteristic->id,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\characteristic  $characteristic
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $characteristic = Characteristic::findOrfail($id);
        $characteristic->delete();
        return response()
        ->json([
            'response' => 'success',
            'eliminado' => true,
        ]);
    }
    public function getpruebas(){
        return Characteristic::with('products')->get();
    }
    
}
