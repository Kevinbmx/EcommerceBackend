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
        // ->json([
        //     // 'model' => Product::filterPaginateOrder()
        //     'model'=>Product::where('user_id', auth()->id())->with('categories')->filterPaginateOrder()
        // ]);
        // return Product::where('user_id', auth()->id())->with('categories')->filterPaginateOrder();
        return Product::with('users')->get();
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

    public function searchProduct($search){
        $product = Product::with('file')
        ->leftJoin('category as ca','ca.id','product.category_id')
                        ->orWhere('product.name','like',"%$search%")
                        ->orWhere('product.modelo','like',"%$search%")
                        ->orWhere('product.brand','like',"%$search%")
                        ->orWhere('product.description','like',"%$search%")
                        ->orWhere('product.uniqueCode','like',"%$search%")
                        ->orWhere('ca.name','like',"%$search%")
                        ->get(['product.*']);
        // $category = Category::leftJoin('product','product.category_id','category.id')
        //                 ->orWhere('product.name','like',"%$search%")
        //                 ->orWhere('product.modelo','like',"%$search%")
        //                 ->orWhere('product.brand','like',"%$search%")
        //                 ->orWhere('product.description','like',"%$search%")
        //                 ->orWhere('product.uniqueCode','like',"%$search%")
        //                 ->orWhere('category.name','like',"%$search%")
        //                 ->distinct()
        //                 ->get(['category.*']);
        $category = Product::leftJoin('category as ca','ca.id','product.category_id')
                            ->orWhere('product.name','like',"%$search%")
                            ->orWhere('product.modelo','like',"%$search%")
                            ->orWhere('product.brand','like',"%$search%")
                            ->orWhere('product.description','like',"%$search%")
                            ->orWhere('product.uniqueCode','like',"%$search%")
                            ->orWhere('ca.name','like',"%$search%") 
                            ->distinct()
                            ->get(['ca.*']);
                
        if(count($product)>0 || count($category)>0){
            return response()
            ->json([
                'product' => $product,
                'category'=> $category
            ]);
        }else{
            echo('vacio');
            // return false;
        }
        

    }
  
}
