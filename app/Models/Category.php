<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category';

    protected $fillable = ['name', 'parent_id','path','pathName'];

    protected $hidden = ['display_order','created_at', 'updated_at'];

    public function parent() {
        return $this->hasOne(Category::class, 'id', 'parent_id')->orderBy('name');
    }

    public function children() {
        return $this->hasMany(Category::class, 'parent_id', 'id')->orderBy('name');
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
    //     return $this->hasMany(Product');
    // }

    public function products(){
        return $this->hasMany(Product::class,'category_id');
    }
}
