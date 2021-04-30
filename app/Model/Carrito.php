<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Product;

class Carrito extends Model
{
    protected $table = 'carrito';

    protected $fillable = ['product_id', 'pedido_id','price','quantity'];

    protected $hidden = ['created_at', 'updated_at'];

    public function product() {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
    public function file(){
        return $this->hasMany('App\model\File','file.product_id','product.id');
    }

    public function productWithFile(){
        return static::with('product')->with('file');
    }
}
