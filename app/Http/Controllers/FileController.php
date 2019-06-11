<?php

namespace App\Http\Controllers;

use App\Model\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Display a listing of the resource by product Id.
     *
     * 
     */
    public function getByProductId($productId)
    {
      $fileByProductId = File::where('product_id',$productId)->get();
      return $fileByProductId;

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
            'name'=> 'required',
            'product_id' => 'required',   
            'path' => 'required',
            
        ]);
        $file = File::create([
            'name'=>$request->name,
            'product_id' => $request->product_id,
            'path' => $request->path,
        ]);
      
        return response()
            ->json([
                'response' => 'success',
                'saved' => true,
                'id'=> $file->id
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'=> 'required',
            'product_id' => 'required',   
            'path' => 'required',
            
        ]);
        $file = File::findOrFail($id);
        $file->update([
            'name'=>$request->name,
            'product_id' => $request->product_id,
            'path' => $request->path,
        ]);
        return response()
        ->json([
            'response' => 'success',
            'saved' => true,
            'id'=> $file->id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = File::findOrfail($id);
        $file->delete();
        return response()
        ->json([
            'response' => 'success',
            'eliminado' => true,
        ]);
    }
}
