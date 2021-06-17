<?php

namespace App\Models;

use App\Models\File;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Carrito extends Model
{
    use HasFactory;
    protected $table = 'carrito';

    protected $fillable = ['product_id', 'pedido_id','price','quantity','unidad_medida'];

    protected $hidden = ['created_at', 'updated_at'];

    public function product() {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
    public function file(){
        return $this->hasMany(File::class,'file.product_id','product.id');
    }

    public function productWithFile(){
        return static::with('product')->with('file');
    }
}
