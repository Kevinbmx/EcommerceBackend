<?php

namespace App\Models;

use App\Models\File;
use App\Models\User;
use App\Models\Category;
use App\Models\Characteristic;
use App\Support\FilterPaginateOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use FilterPaginateOrder;
    protected $table = 'product';
    protected $fillable = [
        'name', 'modelo', 'quantity', 'brand', 'price','category_id',
         'peso','alto','ancho','fondo','parent_id','uniqueCode','statusProduct_id',
         'user_id','description','unidad_medida','enable_kg_per_price','enable'
    ];
    protected $filter = [
        'id', 'name', 'modelo', 'quantity', 'brand', 'price','category_id',
        'peso','alto','ancho','fondo','parent_id','uniqueCode','statusProduct_id','created_at',
        'unidad_medida','enable_kg_per_price','enable'
    ];

    protected $casts = [
        // 'hasChildren' => 'boolean',
        'created_at' => 'datetime:Y-m-d',
    ];

    public function file(){
        return $this->hasMany(File::class,'product_id');
    }

    public function characteristic(){
        return $this->hasMany(Characteristic::class,'product_id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class,'category_id');
        // return $this->hasMany(Category::class,'category_id');
    }

    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }

}
