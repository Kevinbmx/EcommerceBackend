<?php

namespace App\model;

use App\model\Carrito;
use App\model\Product;
use App\model\File;
// use App\model\Direction;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedido';

    protected $fillable = ['estado', 'fecha_entrega','fecha_anulacion','motivo_anulacion','total','user_id','created_at'];

    protected $hidden = ['updated_at'];

    public function carrito(){
        return $this->hasMany(Carrito::class);
    }
    
    public function product() {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
    public function file(){
        return $this->hasMany(File::class,'file.product_id','product.id');
    }

    public function direction(){
        return $this->hasMany(Direction::class,'id','direction_id');
    }


    // public function CarritoWithProductWithFile(){   
    //     return static::with('carrito')->with('product')->with('file');
    // }
}
