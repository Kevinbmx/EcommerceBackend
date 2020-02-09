<?php

namespace App\Http\Controllers;

use App\Model\File;
use App\Model\Product;
use App\Model\Category;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
  
  //------------------------------------------------------------------------------------------------------------
  /**
   * me obtiene el detalle de un producto, mas sus imagenes y sus caracteristica
   */
    public function getProductDetail($productId){
      $product=Product::with('file')->with('characteristic')->where('id',$productId)->get();
      return $product[0];        
  }
//--------------------------------------------------------------------------------------------------------------
  public function productsByCategoryId()
{

  $result = pro::where('id','=',$id)->get();
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


    
}