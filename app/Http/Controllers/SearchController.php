<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchController extends Controller
{
   // private $childrenCategories = collect([]);
   private $childrenCategories = array();
   // private $allProductByCategories = array();

   public function getchildCategoryById($id){
       return Category::with('children')->where('parent_id',$id)->where('enable',1)->orderBy('name', 'asc')->get();
   }

//--------------este metodo getAllChildrenCategoryById va ligado a getRelatedProductbyCategoryId----------------
/**
* me obtiene los hijos de la categoria deseada y lo vuelve en una lista
*/
 public function getAllChildrenCategoryById($id){
   $result = Category::where('parent_id',$id)->get();
   // dd($result);
   foreach ($result as $row) {
     // $count = Category::where('parent_id', $row->id)->count();
     array_push($this->childrenCategories,$row);
     // echo '('.$row->name."-".$row->id.')'.',';
     $this->getAllChildrenCategoryById($row->id , $row->name);
   }
   // dd($this->childrenCategories);
   return $this->childrenCategories;
 }

/**
* me obtine todos los productos a partir de los hijos de las categorias
* que me obtien el metodo getAllChildrenCategoryById
*/
 public function getRelatedProductbyCategoryId($id){
   $allProductByCategories = collect([]);
   $allCategoryById = $this->getAllChildrenCategoryById($id);
   // dd($allCategoryById);
   if($id > 0){
     $ParentCategory = Category::find($id);
     array_unshift($allCategoryById,$ParentCategory);
   }
   foreach ($allCategoryById as $row) {
     $productsByCategoryId =  Product::where('category_id',$row->id)->with('file')->get();
     if(collect($productsByCategoryId)->isNotEmpty()){
       foreach ($productsByCategoryId as $key => $products) {
         $allProductByCategories->push($products);
       }
     }
   }
     // dd($allProductByCategories);
   $per_page =18;
   $currentPage = LengthAwarePaginator::resolveCurrentPage();
   $currentPageResults = collect($allProductByCategories)->splice(($currentPage-1) * $per_page, $per_page)->all();
   $units = new LengthAwarePaginator($currentPageResults, count($allProductByCategories), $per_page);
   return $units;

 }
//---------------------------------------------------------------------------------
 public function searchProduct($search){
   $product = Product::with('file')
            ->leftJoin('category as ca','ca.id','product.category_id')
            ->orWhere('product.name','like',"%$search%")
            ->orWhere('product.modelo','like',"%$search%")
            ->orWhere('product.brand','like',"%$search%")
            ->orWhere('product.description','like',"%$search%")
            ->orWhere('product.uniqueCode','like',"%$search%")
            ->orWhere('ca.name','like',"%$search%")
            // ->distinct()
            // ->paginate(12)
            ->select(['product.*'])->paginate(18);
   $category = Category::RightJoin('product','product.category_id','category.id')
            ->orWhere('product.name','like',"%$search%")
            ->orWhere('product.modelo','like',"%$search%")
            ->orWhere('product.brand','like',"%$search%")
            ->orWhere('product.description','like',"%$search%")
            ->orWhere('product.uniqueCode','like',"%$search%")
            ->orWhere('category.name','like',"%$search%")
            ->distinct()
            ->get(['category.*']);
   // $category = Product::leftJoin('category as ca','ca.id','product.category_id')
   //                     ->orWhere('product.name','like',"%$search%")
   //                     ->orWhere('product.modelo','like',"%$search%")
   //                     ->orWhere('product.brand','like',"%$search%")
   //                     ->orWhere('product.description','like',"%$search%")
   //                     ->orWhere('product.uniqueCode','like',"%$search%")
   //                     ->orWhere('ca.name','like',"%$search%")
   //                     ->distinct()
   //                     ->get(['ca.*']);

   // if(count($product)>0 || count($category)>0){
       return response()
       ->json([
           'product' => $product,
           'category'=> $category
       ]);
   // }else{
   //     echo('vacio');
   //     // return false;
   // }
 }

}
