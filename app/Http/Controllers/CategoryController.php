<?php

namespace App\Http\Controllers;

use App\Helper\Acceso;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\CategoryController;

class CategoryController extends Controller
{
    private $parentCategory = array();

    public function index(){
        $hasPermission = false;
        $CategoryTree ='';
        if(Acceso::hasPermission(Acceso::getListarCategoria())){
            $CategoryTree = Category::tree();
            $hasPermission = true;
        }
        return response()
        ->json([
            'hasPermission' => $hasPermission,
            'CategoryTree'=> $CategoryTree,
        ]);
    }

    //no necesita permiso
    public function categoryParent(){
        return Category::where('parent_id',0)->get();
    }
    public function store(Request $request)
    {
        $hasPermission = false;
        $CategoryTree ='';
        if(Acceso::hasPermission(Acceso::getCrearCategoria())){
            $data = $request->validate([
                'name' => 'required|string',
                'parent_id' => 'required',
                'path'=>'required'
            ]);
            // return $request;
            $category = Category::create([
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'path' => $request->path
            ]);
            $CategoryTree = Category::tree();
            $hasPermission = true;
        }
        return response()
        ->json([
            'hasPermission' => $hasPermission,
            'CategoryTree'=> $CategoryTree,

        ]);
    }

    public function byId($categoryId){
        if(Acceso::hasPermission(Acceso::getActualizarCategoria())){
            $category = Category::find($categoryId);
            return $category;
        }
    }
/**
 * addParent
 * me obtiene el request del front end con los categorias chequeadas , el nombre, y el parent_id
 * y asi crear un padre y modificar las anteriores al nuevo id que se creo....
 */
    public function addParent(Request $request)
    {
        $hasPermission = true;
        $CategoryTree = '';
        if(Acceso::hasPermission(Acceso::getCrearCategoria())){
            $checkedCategories = $request->input('checkedCategories');
            $data = $request->validate([
                'name' => 'required|string',
                'parent_id' => 'required',
                'path'=>'required'
            ]);
            $newCategory = Category::create([
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'path' => $request->path
            ]);

            if (empty($checkedCategories)){
                return 'no tiene categorias chequeadas';
            }
            foreach($checkedCategories as $categoryChange){
                $cambio = Category::where('id',$categoryChange['id'])
                ->update(['parent_id' => $newCategory->id]);
            }
            $CategoryTree = Category::tree();
            $hasPermission = true;
        }
        return response()
        ->json([
            'hasPermission' => $hasPermission,
            'CategoryTree'=> $CategoryTree,
        ]);
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
        if(Acceso::hasPermission(Acceso::getActualizarCategoria())){
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
    }

    public function destroy(Category $category )
    {
        $hasPermission = false;
        $CategoryTree ='';
        if(Acceso::hasPermission(Acceso::getEliminarCategoria())){
            Category::where('parent_id',$category->id)
            ->update(['parent_id' => $category->parent_id]);
            $category->delete();
            $CategoryTree = Category::tree();
            $hasPermission = true;
        }
        return response()
        ->json([
            'hasPermission' => $hasPermission,
            'CategoryTree'=> $CategoryTree,
        ]);
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

    public function getchildCategory(){
        return Category::with('children')->where('parent_id',0)->where('enable', 1)->orderBy('name', 'asc')->get();
    }

    // public function getpruebas(){
    //     return Category::with('products')->get();
    // }

}
