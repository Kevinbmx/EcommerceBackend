<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;

class CategoryController extends Controller
{
    private $parentCategory = array();
    
    public function index(){
        return Category::tree();
    }
   
    public function categoryParent(){
        return Category::where('parent_id',0)->get();
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'parent_id' => 'required',
            'path'=>'required'
        ]);
        $category = Category::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'path' => $request->path
        ]);
        $allCategories= $this->index();
        return response($allCategories, 201);
    }

    public function byId($categoryId){
        $category = Category::find($categoryId);
        return $category;
    }
/**
 * addParent
 * me obtiene el request del front end con los categorias chequeadas , el nombre, y el parent_id 
 * y asi crear un padre y modificar las anteriores al nuevo id que se creo....
 */
    public function addParent(Request $request)
    {
        $checkedCategories = $request->input('checkedCategories');
        $nameCategory = $request->input('name');
        $parent_id= $request->input('parent_id');

        $data = $request->validate([
            'name' => 'required|string',
            'parent_id' => 'required',
        ]);
        $newCategory = Category::create([
            'name' => $nameCategory,
            'parent_id' => $parent_id,
        ]);

        if (empty($checkedCategories)){
            return 'no tiene categorias chequeadas';
        }

        foreach($checkedCategories as $categoryChange){
            $cambio = Category::where('id',$categoryChange['id'])
            ->update(['parent_id' => $newCategory->id]);
        }
        $allCategories= $this->index();
        return response($allCategories, 201);
    }
    //---------------para el main page-----------------------
    public function getRandomCategory(){
        $categories=Category::where('parent_id',0)->get()->random(4);
        return $categories;        
    }
    //-------------------------------------------------------------

    // public function update(Request $request, Category $category)
    // {
    //     $data = $request->validate([
    //         'name' => 'required|string',
    //         'parent_id' => 'required',
    //     ]);

    //     $category->update($data);

    //     return response($category, 200);
    // }
    public function update(Request $request,$id){
        $data = $request->validate([
            'path' => 'required|string',    
            'pathName' => 'required|string',
        ]);
        $category = Category::find($id);

        $category->path = $request->path;
        $category->pathName = $request->pathName;

        $category->save();
       return response($category,201);
    }

    public function destroy(Category $category )
    {  
        Category::where('parent_id',$category->id)
        ->update(['parent_id' => $category->parent_id]);
        $category->delete();
        $allCategories= $this->index();
        return response($allCategories, 201);
    }


    public function getParentCategory($id){
        $result = Category::where('id','=',$id)->get();
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

    public function getpruebas(){
        return Category::with('products')->get();
    }
}
