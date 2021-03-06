<?php

namespace App\Http\Controllers;

use App\Helper\Acceso;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(){
        // --------------------ESTE SIRVE----------------
        $hasPermission = false;
        $productWithUser='';
        if(Acceso::hasPermission(Acceso::getlistarProducto())){
            $productWithUser = Product::orderBy('created_at','desc')->get();
            $hasPermission = true;
        }
        return response()
        ->json([
            'hasPermission' => $hasPermission,
            'productWithUser'=> $productWithUser,

        ]);
        // ----------------------------------------------
    }

    public function store(Request $request)
    {
        if(Acceso::hasPermission(Acceso::getCrearProducto())){
            $this->validate($request, [
                'name' => 'required',
                'modelo' => 'required',
                'quantity' => 'required|numeric|min:0',
                'brand' => 'required',
                'price' => 'required|numeric',
                'category_id' =>'required',
                'peso' => 'required',
                'alto' => 'required',
                'ancho'=> 'required',
                'fondo'=> 'required',
            ]);
            $uuid = Str::uuid();
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
                'description'=>$request->description,
                'unidad_medida' => $request->unidad_medida,
                'enable_kg_per_price' =>$request->enable_kg_per_price,
                'enable' => $request->enable
            ]);
            return response()
                ->json([
                    'saved'=>true,
                    'product_id'=> $product->id,
                    'type'=> 'create'
                ]);
        }
    }

    public function updateProductAccoodingPedido(Request $request){
        // if(Acceso::hasPermission(Acceso::getActualizarProducto())){
            $isupdated = false;
            // return $request;
            // return $request->request->all() ;
            DB::beginTransaction();
            try{
                $productUpdate = 0;
                foreach ($request->request->all() as $carrito) {
                    // $respuesta = $this->update($carrito['product'],$carrito['product']['id']);
                    $product = Product::findOrFail($carrito['product']['id']);
                    if($carrito['quantity']  <= $product['quantity']){
                        $product['quantity'] -= $carrito['quantity'];
                        $product->update(['quantity' => $product['quantity']]);
                        // return $product;
                        $productUpdate ++;
                    }
                }
                if($productUpdate < count($request->request->all())){
                    DB::rollback();
                    $isupdated = false;
                }else{
                $isupdated = true;
                }
            } catch (\Exception $e) {
                // echo ' , entra';
                DB::rollback();
                return response()
                ->json([
                    'update' => false,
                ]);
            }
            DB::commit();
            return response()
                ->json([
                    'update' => $isupdated ,
                ]);
        // }
    }

    public function update(Request $request, $idProduct)
    {
        if(Acceso::hasPermission(Acceso::getActualizarProducto())){
        // return $request;
            $this->validate($request, [
                'name' => 'required',
                'modelo' => 'required',
                'quantity' => 'required|numeric|min:0',
                'brand' => 'required',
                'price' => 'required|numeric',
                'category_id' =>'required',
                'peso' => 'required',
                'alto' => 'required',
                'ancho'=> 'required',
                'fondo'=> 'required',
            ]);
            $product = Product::findOrFail($idProduct);
            // return $product;
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
                'description'=>$request->description,
                'unidad_medida' => $request->unidad_medida,
                'enable_kg_per_price' =>$request->enable_kg_per_price,
                'enable' => $request->enable
            ]);
            // return $product;
            return response()
            ->json([
                'saved' => true,
                'product_id'=> $idProduct,
                'type'=> 'update'
            ]);
        }
    }
    public function habilitar(Request $request,$idProduct)
    {
        try {
            $product = '';
            if(Acceso::hasPermission(Acceso::getActualizarProducto())){
                $this->validate($request, [
                    'enable'=> 'required',
                ]);
                    $product = Product::findOrFail($idProduct);
                    // return $product;
                    $product->update([
                        'enable' => (bool) $request->enable
                    ]);
                    // return $product;
                    return response()
                    ->json([
                        'saved' => true,
                        'product'=> $product,
                        'type'=> 'update'
                    ]);
            }
        } catch (\Throwable $th) {
            return response()
            ->json([
                'saved' => false,
                'product'=> $product,
                'type'=> 'update'
            ]);
        }
    }

    public function getById($idProduct)
    {
        $hasPermission = false;
        $ProductById ='';
        if(Acceso::hasPermission(Acceso::getActualizarProducto())){
            $ProductById = Product::where('id',$idProduct)->first();
            $hasPermission = true;
        }
        return response()
        ->json([
            'hasPermission' => $hasPermission,
            'ProductById'=> $ProductById,

        ]);
    }

}
