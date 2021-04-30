<?php

namespace App\Models;

use App\Models\File;
use App\Models\User;
use App\Models\Carrito;
use App\Models\Product;
use App\Models\Direction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pedido extends Model
{
    use HasFactory;
    protected $table = 'pedido';

    protected $fillable = ['estado', 'fecha_entrega','fecha_anulacion','motivo_anulacion','total','user_id','created_at','updated_at'];

    // protected $hidden = ['updated_at'];

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
        return $this->hasOne(Direction::class,'id','direction_id');
    }

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    // public function CarritoWithProductWithFile(){
    //     return static::with('carrito')->with('product')->with('file');
    // }
}
