<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Model\Category;
use App\Model\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;


class PerCategoryController extends Controller
{
    // private $childrenCategories = collect([]);
    private $childrenCategories = array();
    // private $allProductByCategories = array();

    public function getchildCategoryById($id){
        return Category::with('children')->where('parent_id',$id)->orderBy('name', 'asc')->get();
    }
    
//--------------este metodo getAllChildrenCategoryById va ligado a getRelatedProductbyCategoryId----------------
/**
 * me obtiene los hijos de la categoria deseada y lo vuelve en una lista
 */
  public function getAllChildrenCategoryById($id){
    $result = Category::where('parent_id',$id)->get();
    foreach ($result as $row) {
      // $count = Category::where('parent_id', $row->id)->count();
      array_push($this->childrenCategories,$row);
      // echo '('.$row->name."-".$row->id.')'.',';
      PerCategoryController::getAllChildrenCategoryById($row->id);
    }
    return $this->childrenCategories;
  }
  
/**
 * me obtine todos los productos a partir de los hijos de las categorias
 * que me obtien el metodo getAllChildrenCategoryById
 */
  public function getRelatedProductbyCategoryId($id){
    $allProductByCategories = collect([]);
    $allCategoryById = $this->getAllChildrenCategoryById($id);
    if($id > 0){
      $ParentCategory = Category::find($id);
      array_unshift($allCategoryById,$ParentCategory);
    }
    foreach ($allCategoryById as $row) {
      $productsByCategoryId =  Product::where('category_id',$row->id)->with('file')->get();
    //   dd($productsByCategoryId->lengh());
      if(collect($productsByCategoryId)->isNotEmpty()){
        foreach ($productsByCategoryId as $key => $products) {
          $allProductByCategories->push($products);
        }
      }
    }

    $per_page = 15;
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $currentPageResults = collect($allProductByCategories)->splice(($currentPage-1) * $per_page, $per_page)->all();
    $units = new LengthAwarePaginator($currentPageResults, count($allProductByCategories), $per_page);
    return $units;
    
  }
//---------------------------------------------------------------------------------

}
