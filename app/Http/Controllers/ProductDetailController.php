<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\CategoryController;
use App\Models\Category;

class ProductDetailController extends Controller
{
    private $salida = array();
    // private $contarProductos = 0;

  //------------------------------------------------------------------------------------------------------------
  /**
   * me obtiene el detalle de un producto, mas sus imagenes y sus caracteristica
   */
  public function getProductDetail($productId){
    $product=Product::with('file')->with('characteristic')->where('enable',1)->where('id',$productId)->get();
    return response()
    ->json([
        'product'=> $product,
    ]);
    // return $product;
    }
//--------------------------------------------------------------------------------------------------------------
    public function productsByCategoryId()
    {

        $result = Product::where('id','=',$id)->get();
        foreach ($result as $row) {
            if ($row->parent_id >= 0)
            {
                array_push($this->parentCategory,$row);
                    // echo '('.$row->name."-".$row->id.'),';
                CategoryController::getParentCategory($row->parent_id);
                return $this->parentCategory  ;
            }
        }
    }
    //-------------------- todo esto es para el producto relacionado-------------------------
    //--------------- o para los productos que le pueden interesar----------------
    //---------------para el main page (no tinee que tener permiso)-----------------------
    public function getRandomProduct($random){
        $product=Product::with('file')->where('enable',1)->get()->random($random);
        return $product;
    }
    public function getRelatedProduct($id, $max){
        $categoryWithParentAndProducts = Category::with('onlyParent')->where('id',$id)->get()->first();
        $cantidadchildrenParentProducts= 0;
        if($categoryWithParentAndProducts->onlyParent != null){
          if($categoryWithParentAndProducts->onlyParent->childrenWithProducts != null){
            $childrenParentProducts = $categoryWithParentAndProducts->onlyParent->childrenWithProducts;
            $this->recorrerAllParentForOptainProducts($childrenParentProducts,$max);
            $cantidadchildrenParentProducts =  count(collect($this->salida));
          if($cantidadchildrenParentProducts > 0 && $cantidadchildrenParentProducts < $max){
            $this->getRelatedProduct($categoryWithParentAndProducts->onlyParent['id'],$max);
           }
         }
       }
        $cantidadchildrenParentProducts =  count(collect($this->salida));
        if($cantidadchildrenParentProducts < $max){
            $random = $this->getRandomProduct($max - $cantidadchildrenParentProducts);
            foreach ($random as  $variable) {
                array_push($this->salida, $variable);
            }
        }
        return( array_intersect_key( $this->salida, array_flip( array_rand( $this->salida, $max ) ) ) );
        // return($this->salida);
     }

     public function recorrerAllParentForOptainProducts($entrada,$max){
         foreach($entrada as $row){
             // print($row);
             if(count($row['products']) > 0 ) {
                 foreach ($row['products'] as $row1) {
                    // if($this->contarProductos < ($max)){
                        array_push($this->salida, $row1);
                        // $this->contarProductos ++;
                    // }else{
                    //     return;
                    // }
                 }
             }
         }
     }
     //--------------------------------------------------------------------------------------------
}
