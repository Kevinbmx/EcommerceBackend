<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;
use App\model\Category;
use App\model\characteristic;


class Product extends Model
{
    use FilterPaginateOrder;
    protected $table = 'product';
    protected $fillable = [
        'name', 'modelo', 'quantity', 'brand', 'price','category_id', 'peso','alto','ancho','fondo','parent_id','uniqueCode','statusProduct_id','user_id','description'
    ];
    protected $filter = [
        'id', 'name', 'modelo', 'quantity', 'brand', 'price','category_id', 'peso','alto','ancho','fondo','parent_id','uniqueCode','statusProduct_id','created_at'
    ];

    protected $casts = [
        // 'hasChildren' => 'boolean',
        'created_at' => 'datetime:Y-m-d',
    ];

    public function file(){
        return $this->hasMany(File::class,'product_id');
    }
    
    public function characteristic(){
        return $this->hasMany(characteristic::class,'product_id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class,'category_id');
        // return $this->hasMany(Category::class,'category_id');
    }

    public function users(){
        return $this->belongsTo('App\model\User','user_id');
    }
}
