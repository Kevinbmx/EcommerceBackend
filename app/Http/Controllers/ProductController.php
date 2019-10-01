<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Category;
use Webpatser\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(){
        // return response()
        //     ->json([
        //         'model' => Product::filterPaginateOrder()
        //     ]);
        // return response()
        // ->json([
        //     // 'model' => Product::filterPaginateOrder()
        //     'model'=>Product::where('user_id', auth()->id())->with('categories')->filterPaginateOrder()
        // ]);
        // return Product::where('user_id', auth()->id())->with('categories')->filterPaginateOrder();

        // --------------------ESTE SIRVE----------------
        return Product::with('users')->get();
        // ----------------------------------------------

        //  $id = $this->Auth::user();
        //  return $id;
        //     $product = Product::with('categories')->filterPaginateOrder();
        // return $product;
        // dd( Product::all());
    }
      //---------------para el main page-----------------------
    public function getRandomProduct(){
        $product=Product::with('file')->get()->random(6);
        return $product;        
    }
    //-------------------------------------------------------------

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',   
            'modelo' => 'required',
            'quantity' => 'required|Integer|min:0',
            'brand' => 'required',
            'price' => 'required|numeric',
            'category_id' =>'required',
            'peso' => 'required',
            'alto' => 'required',
            'ancho'=> 'required',
            'fondo'=> 'required',
        ]);
        $uuid = Uuid::generate(1);
        $IdUser = auth()->id();
        $product = Product::create([
            'name' => $request->name,
            'modelo' => $request->modelo,
            'quantity' => $request->quantity,
            'brand' => $request->brand,
            'price' => $request->price,
            'category_id' =>$request->category_id,
            'peso' => $request->peso,
            'alto' => $request->alto,
            'ancho'=> $request->ancho,
            'fondo'=> $request->fondo,
            'parent_id'=> $request->parent_id,
            // 'hasChildren' => $request->hasChildren,
            'uniqueCode'=>$uuid,
            'statusProduct_id'=>$request->statusProduct_id,
            'user_id'=> $IdUser,
            'description'=>$request->description
        ]);
        return response()
            ->json([
                'create'=>true,
                'product_id'=> $product->id,
                'type'=> 'create'
            ]);
    }

    public function update(Request $request, $idProduct)
    {
        $this->validate($request, [
            'name' => 'required',   
            'modelo' => 'required',
            'quantity' => 'required|Integer|min:0',
            'brand' => 'required',
            'price' => 'required|numeric',
            'category_id' =>'required',
            'peso' => 'required',
            'alto' => 'required',
            'ancho'=> 'required',
            'fondo'=> 'required',
        ]);
        $product = Product::findOrFail($idProduct);
        // return $request;
        $product->update([
            'name' => $request->name,
            'modelo' => $request->modelo,
            'quantity' => $request->quantity,
            'brand' => $request->brand,
            'price' => $request->price,
            'category_id' =>$request->category_id,
            'peso' => $request->peso,
            'alto' => $request->alto,
            'ancho'=> $request->ancho,
            'fondo'=> $request->fondo,
            'parent_id'=> $request->parent_id,
            'statusProduct_id'=>$request->statusProduct_id,
            'description'=>$request->description
        ]);
        return response()
        ->json([
            'saved' => true,
            'product_id'=> $idProduct,
            'type'=> 'update'
        ]);
    }

    public function getById($idProduct)
    {  
        $IdUser = auth()->id();
        $ProductById = Product::where('id',$idProduct)->where('user_id',$IdUser)->get();
        return $ProductById[0];

    }
    
    public function destroy(Product $product )
    {  
    }


}
