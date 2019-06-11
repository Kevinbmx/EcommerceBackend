<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use App\model\Product;

class Category extends Model
{
    protected $table = 'category';
  
    protected $fillable = ['name', 'parent_id','path','pathName'];

    protected $hidden = ['display_order','created_at', 'updated_at'];

    public function parent() {
        return $this->hasOne('App\model\Category', 'id', 'parent_id')->orderBy('name');
    }
    
    public function children() {
        return $this->hasMany('App\model\Category', 'parent_id', 'id')->orderBy('name');
    }
    
    public static function tree() {
        return static::with(implode('.', array_fill(0, 100, 'children')))->where('parent_id', '=', '0')->orderBy('name')->get();
    }

    public static function getRelatedProduct($id){
        return static::with('products')->with(implode('.', array_fill(0, 100, 'children')))->where('id', '=', $id)->orderBy('name')->get();
    }

    // public static function getParentsById($id){
    //     return static::with(implode('.', array_fill(0, 100, 'parent')))->where('id', '=', $id)->orderBy('name')->get();
    // }

    // public function products(){
    //     return $this->hasMany('App\model\Product');
    // }

    public function products(){
        return $this->hasMany(Product::class,'category_id');
    }
}
